<?php 
$view_path = base_path().'/resources/views/layouts';
require($view_path.'/intro-header.php');
?>

<div id="page-wrapper">
    <!-- Header -->
        <div id="header-wrapper" class="wrapper">
            <div id="header">

                <!-- Logo -->
                    <div id="logo">
                        <h1><a href="index.html">Analytic Machine</a></h1>
                        <p>Visualize your potential profits from the tips of your fingers</p>
                    </div>

                <!-- Nav -->
                    <nav id="nav">
                        <ul>
                            <li class="current"><a href="#header">Home</a></li>
                            <li><a href="#introduction">Introduction</a></li>
                            <li><a href="#details">Details</a></li>
                            <li><a href="#contact_us">Contact Us</a></li>
                        </ul>
                    </nav>

            </div>
        </div>

    <!-- Intro -->
        <div id="intro-wrapper" class="wrapper style1">
            <div class="title" id="introduction">Introduction</div>
            <section id="intro" class="container">
                <p class="style1">So in case you were wondering what this is all about ...</p>
                <p class="style2">
                    Analytic Machine helps you to see the potential profits from your data.
                </p>
                <p class="style3">You <strong>upload</strong> your data. You <strong>search</strong> what you want to see in your data. We will give you <strong>visual results</strong> instantly.</p>
            </section>
        </div>

    <!-- Main -->
        <div class="wrapper style2">
            <div class="title" id="details">Details</div>
            <div id="main" class="container">

                <!-- Features -->
                    <section id="features">

                        <div class="feature-list">
                            <div class="row">
                                <div class="4u 12u(mobile)">
                                    <section>
                                        <h3 class="icon fa-upload">Upload CSV file</h3>
                                        <p>You can simply upload your data in CSV format to our system in order to analyse your data.</p>
                                    </section>
                                </div>
                                <div class="4u 12u(mobile)">
                                    <section>
                                        <h3 class="icon fa-search">Search your data</h3>
                                        <p>Once the data is uploaded, you can start typing with dynamic search options for what you would like to see.</p>
                                    </section>
                                </div>
                                <div class="4u 12u(mobile)">
                                    <section>
                                        <h3 class="icon fa-bar-chart">Visualize potential</h3>
                                        <p>You can see various graphs and data according to your searches. We cater to your needs instantly.</p>
                                    </section>
                                </div>                                      
                            </div>
                        </div>
                        <ul class="actions actions-centered">
                            <li><a href="/home" class="button style1 big">Get Started</a></li>
                        </ul>
                    </section>

            </div>
        </div>

    <!-- Footer -->
        <div id="footer-wrapper" class="wrapper">
            <div class="title" id="contact_us">Contact Us</div>
            <div id="footer" class="container">
                <header class="style1">
                    <h2>Are you interested in getting to know more?</h2>
                    <p>
                        You can contact us now to find out more. We will walk you through getting started.
                    </p>
                </header>
                <hr />
                <div class="row 150%">
                    <div class="6u 12u(mobile)">

                        <!-- Contact Form -->
                            <section>
                                <form method="post" action="#">
                                    <div class="row 50%">
                                        <div class="6u 12u(mobile)">
                                            <input type="text" class="form-field" name="name" id="name" placeholder="Name" />
                                        </div>
                                        <div class="6u 12u(mobile)">
                                            <input type="text" name="email" class="form-field" id="email" placeholder="Email" />
                                        </div>
                                    </div>
                                    <div class="row 50%">
                                        <div class="12u">
                                            <textarea name="message" id="message" class="form-field" placeholder="Message" rows="4"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="12u" id="success_email_msg" style="font-weight:bold;color:#e97770;"></div>
                                    </div>    
                                    <div class="row">
                                        <div class="12u">
                                            <ul class="actions">
                                                <li><input type="submit" class="style1" value="Send" onClick="return sendEmail();"/></li>
                                            </ul>
                                        </div>
                                    </div>
                                </form>
                            </section>

                    </div>
                    <div class="6u 12u(mobile)">

                        <!-- Contact -->
                            <section class="feature-list small">
                                <div class="row">
                                    <div class="6u 12u(mobile)">
                                        <section>
                                            <h3 class="icon fa-home">Mailing Address</h3>
                                            <p>
                                                Analytic Machine<br />
                                                692 Elgin St.<br />
                                                Newmarket, ON L3Y 3B4
                                            </p>
                                        </section>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="6u 12u(mobile)">
                                        <section>
                                            <h3 class="icon fa-envelope">Direct Email</h3>
                                            <p>
                                                <a href="#">rkang.sendme@gmail.com</a>
                                            </p>
                                        </section>
                                    </div>
                                    <div class="6u 12u(mobile)">
                                        <section>
                                            <h3 class="icon fa-phone">Phone</h3>
                                            <p>
                                                (905) 806-3584
                                            </p>
                                        </section>
                                    </div>
                                </div>
                            </section>

                    </div>
                </div>
                <hr />
            </div>
            <div id="copyright">
                <ul>
                    <li>&copy; Analytic Machine</li><li id="year"></li>
                </ul>
            </div>
        </div>
</div>

<script src="<?php echo asset('js/jquery-1.12.0.min.js'); ?>"></script>
<script src="<?php echo asset('js/jquery.dropotron.min.js'); ?>"></script>
<script src="<?php echo asset('js/skel.min.js'); ?>"></script>
<script src="<?php echo asset('js/skel-viewport.min.js'); ?>"></script>
<script src="<?php echo asset('js/util.js'); ?>"></script>
<!--[if lte IE 8]><script src="js/ie/respond.min.js"></script><![endif]-->
<script src="<?php echo asset('js/main.js'); ?>"></script>
<?php 
require($view_path.'/footer.php'); 
?>
