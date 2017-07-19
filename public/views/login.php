<main role="main">
    <section class="section background-white">
        <div class="s-12 m-12 l-4 center">
            <h4 class="text-size-20 margin-bottom-20 text-dark text-center">Login</h4>
            <!--Login Form-->
            <form name="contactForm" class="customform" method="post" action="/prc/login">
                <div class="s-12">
                    <div class="margin">
                        <div class="s-12 m-12 l-6">
                            <!--Email Input-->
                            <input name="email" required="required" class="required email" placeholder="Email" title="email" type="text">
                        </div>
                        <div class="s-12 m-12 l-6">
                            <!--Password Input-->
                            <input name="password" required="required" class="name" placeholder="Password" title="password" type="text">
                        </div>
                    </div>
                </div>
                <div class="">
                    <!--Submit Button-->
                    <button class="s-12 l-6 submit-form button background-primary text-white" type="submit">Submit</button>
                    <button id="button--reset-return" type="reset" class="l-6"><i class="fa fa-arrow-left"></i> Kembali</button>
                </div>
            </form>
        </div>
    </section>
</main>

<script>
	$(document).ready(function () {
		$('#button--reset-return').on('click', function () {
			window.location.replace('/');
		});
	});
</script>
