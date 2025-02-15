<div class="container">
    <h1>IndexController/index</h1>
    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <h3>What happens here ?</h3>
        <p>
            This is the homepage where the students of LBS Eibiswald learn how a homepage is structured using the Huge framework. <br>
            Implementations mainly involve PHP, jQuery, and JavaScript. In the background, SQL with phpMyAdmin is used in conjunction with software (Laragon).
            As no real URL-route (like /register/index) is provided, the app uses the default
            controller and the default action, defined in application/config/config.php, by default it's
            IndexController and index()-method. <br>
            So, the app will load application/controller/IndexController.php and run index() from that file. Easy. <br>
            That index()-method (= the action) has just one line of code inside
            ($this->view->render('index/index');) that loads application/view/index/index.php, which is basically
            this text you are reading right now.
        </p>
    </div>
</div>
