

<?php $this->beginContent('@app/views/layouts/html/html_simple.php'); ?>

<!-- Start Page Loading -->
    <div id="loader-wrapper">
        <div id="loader"></div>        
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
<!-- End Page Loading -->
	
	<?= $this->render('partial/left_sidebar.php') ?>

    <!-- //////////////////////////////////////////////////////////////////////////// -->

    <!-- START MAIN -->
    <div id="main">
        <!-- START WRAPPER -->
        <div class="wrapper">   

            <!-- //////////////////////////////////////////////////////////////////////////// -->

            <!-- START CONTENT -->
            <section id="content">

                <!--start container-->
                <div class="container">	

					<?= $content ?>

				</div>
			</section>

			<?= $this->render('partial/right_sidebar.php') ?>
		</div>
	</div>

	<?= $this->render('partial/footer.php') ?>

<?php $this->endContent(); // HTML ?>