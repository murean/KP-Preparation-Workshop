<?php

namespace Article;

use Controller;
use Database;
use Flight;
use Parsedown;
use Session;

class Article extends Controller
{

    private $image_dir = '/img/attachment/original',
        $thumbnail_dir = '/img/attachment/thumbnail';

    /**
     * Writer Create Article
     * @return void
     */
    public function create()
    {
        // insert into article
        $query = 'INSERT INTO article (`title`, `content`, `creator`,
            `created_at`, `summary`) VALUES (:title, :content, :creator, NOW(),
            :summary)';

        $parameters = [
            'title' => $this->request->data->title,
            'content' => $this->request->data->content,
            'creator' => $this->session['id'],
            'summary' => $this->request->data->summary
        ];

        $result = Database::TransactionQuery($query, $parameters, true);

        if (!$result) {
            redirect('/writer/article/creator', 'Gagal Membuat Artikel', 'error');
            exit();
        }

        if ($result) {
            $basename = 'img-' . $result . '.jpg';
            $destination['original'] = $_SERVER['DOCUMENT_ROOT'] . $this->image_dir;
            $destination['thumbnail'] = $_SERVER['DOCUMENT_ROOT'] . $this->thumbnail_dir;
            $image_result = uploadImage($this->request->files->image, $basename, $destination);
            if (!$image_result) {
                redirect('/writer/article/creator', 'Gagal Mengunggah Gambar', 'error');
                exit();
            }
        }

        // return to creator view
        redirect('/writer/article/creator', 'Berhasil Membuat Artikel', 'success');
    }

    /**
     * Update An Article
     * @return [type] [description]
     */
    public function update()
    {
        $query = 'UPDATE article SET title = :title,
            content = :content, updated_at = NOW()
            WHERE id = :id AND creator = :creator';

        $parameters = [
            'title' => $this->request->data->title,
            'content' => $this->request->data->content,
            'id' => $this->request->data->id,
            'creator' => $this->session['id']
        ];

        $result = Database::TransactionQuery($query, $parameters);
        if (!$result) {
            redirect('/writer/article/editor/' . $this->request->data->id, 'Gagal Mengedit Artikel', 'error');
            exit();
        }
        $image = $this->request->files->image;

        if ($image['size']) {
            $basename = 'img-' . $this->request->data->id . '.jpg';
            $destination['original'] = $_SERVER['DOCUMENT_ROOT'] . $this->image_dir;
            $destination['thumbnail'] = $_SERVER['DOCUMENT_ROOT'] . $this->thumbnail_dir;
            $result = uploadImage($image, $basename, $destination);
            if (!$result) {
                // redirect to failed editor page
                redirect('/writer/article/editor/' . $this->request->data->id, 'Gagal Mengunggah Gambar', 'error');
                exit();
            }
        }

        // return to success view
        redirect('/writer/article/editor/' . $this->request->data->id, 'Berhasil Mengedit Artikel', 'success');
    }

    public static function getDataForUpdate(int $id)
    {
        $query = 'SELECT id, title, content, creator, summary '
            . ' FROM article'
            . ' WHERE id = :id';

        return Database::SelectQuery($query, ['id' => $id], false);
    }

    /**
     * Writer Delete An Article
     * @return void
     */
    public function delete(int $id)
    {
        $query = 'UPDATE `article` SET deleted_at = NOW()
            WHERE id = :id';

        $parameters = [
            'id' => $id
        ];

        $result = Database::TransactionQuery($query, $parameters);

        $message = ($result) ? 'Berhasil Menghapus Artikel' : 'Gagal Menghapus Artikel';
        $message_type = ($result) ? 'success' : 'error';
        // redirect to previous page
        $referrer = $_GET['ref'];

        redirect($referrer, $message, $message_type);
    }

    /**
     * Get Article data limited to id, title, and summary
     * @param int $offset
     * @param bool $owned
     * @return mixed
     */
    public static function getList(int $offset, $owned = false)
    {
        $keyword = Flight::request()->query->title;
        $parameters = [];

        $query = 'SELECT a.id, a.title, a.summary, a.created_at, a.updated_at '
            . ' FROM article AS a';
        $query_counter = 'SELECT COUNT(a.id) AS total FROM article AS a';

        // search by title too
        if ($keyword) {
            // fulltext query snippet
            $filter = ' WHERE MATCH(`a`.`title`) AGAINST (:keyword IN BOOLEAN MODE) AND a.deleted_at IS NULL';
            // normal query
            $query .= $filter;
            // counter query
            $query_counter .= $filter;
            // same parameter for both
            $parameters['keyword'] = preg_replace('/(\w+)/', '$1*', $keyword); // add * after each words
        } else {
            $filter = ' WHERE a.deleted_at IS NULL';
            $query .= $filter;
            $query_counter .= $filter;
        }

        if ($owned) {
            $filter = ' AND a.creator = :id';
            $query .= $filter;
            $query_counter .= $filter;
            $parameters['id'] = Session::GetSessionData()['id'];
        }

        $query .= ' ORDER BY a.updated_at DESC, a.created_at DESC' . snippetOffsetSQL($offset);

        $result['dataset'] = Database::SelectQuery($query, $parameters);
        $result['offsets'] = paginationCounter(
            Database::SelectQuery($query_counter, $parameters, false)['total']
        );

        return $result;
    }

    /**
     * Read an Article
     * @param int $id
     * @return type
     */
    public static function read(int $id)
    {
        include VENDOR . '/parsedown/Parsedown.php';
        // Update Hit
        $query_update_hit = 'UPDATE article SET hit = hit + 1 WHERE id = :id';
        $parameter_update_hit = ['id' => $id];

        $result = Database::TransactionQuery($query_update_hit, $parameter_update_hit);

        if (!$result) {
            return false;
        }

        $query = 'SELECT a.id, a.title, a.content, a.creator, a.created_at, '
            . ' a.updated_at, '
            . ' u.name'
            . ' FROM article AS a'
            . ' LEFT JOIN user AS u ON u.id = a . creator'
            . ' WHERE a.id = :id';

        $data = Database::SelectQuery($query, ['id' => $id], false);

        if (!$data) {
            return false;
        }

        // parse markdown to HTML
        $data['content'] = (new Parsedown())->text($data['content']);

        return $data;
    }

}
