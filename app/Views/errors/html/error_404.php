<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?= lang('Errors.pageNotFound') ?></title>

    <style type="text/css">
        body{font-family: 'Arial Black', cursive;}
        h1{font-size: 2rem; margin: 5px 0px;}
        a,
        a:focus,
        a:hover {
            color: #fff;
        }
        html,
        body {
            height: 100%;
            background-color: #333;
        }
        body {
            color: #fff;
            text-align: center;
            text-shadow: 0 .05rem .1rem rgba(0,0,0,.5);
        }

        .site-wrapper {
            display: table;
            width: 100%;
            height: 100%; /* For at least Firefox */
            min-height: 100%;
            -webkit-box-shadow: inset 0 0 5rem rgba(0,0,0,.5);
            box-shadow: inset 0 0 5rem rgba(0,0,0,.5);
        }
        .site-wrapper-inner {
            display: table-cell;
            vertical-align: top;
        }
        .cover-container {
            margin-right: auto;
            margin-left: auto;
        }

        .inner {
            padding: 2rem;
        }

        .masthead {
            margin-bottom: 2rem;
        }

        .masthead-brand {
            margin-bottom: 0;
        }

        .nav-masthead .nav-link {
            padding: .25rem 0;
            font-weight: bold;
            color: rgba(255,255,255,.5);
            background-color: transparent;
            border-bottom: .25rem solid transparent;
        }

        .nav-masthead .nav-link:hover,
        .nav-masthead .nav-link:focus {
            border-bottom-color: rgba(255,255,255,.25);
        }

        .nav-masthead .nav-link + .nav-link {
            margin-left: 1rem;
        }

        .nav-masthead .active {
            color: #fff;
            border-bottom-color: #fff;
        }

        @media (min-width: 48em) {
            .masthead-brand {
                float: left;
            }
            .nav-masthead {
                float: right;
            }
        }

        .cover {
            padding: 0 1.5rem;
        }
        .cover .btn-lg {
            padding: .75rem 1.25rem;
            font-weight: bold;
        }

        .mastfoot {
            color: rgba(255,255,255,.5);
        }

        @media (max-width: 40em) {

            .cover-container {
                margin-right: auto;
                margin-left: auto;
                margin-top: 100px;
            }
        }
        @media (min-width: 40em) {
            h1{font-size: 4rem;}
            /* Pull out the header and footer */
            .masthead {
                position: fixed;
                top: 0;
            }
            .mastfoot {
                position: fixed;
                bottom: 0;
            }
            /* Start the vertical centering */
            .site-wrapper-inner {
                vertical-align: middle;
            }
            /* Handle the widths */
            .masthead,
            .mastfoot,
            .cover-container {
                width: 100%; /* Must be percentage or pixels for horizontal alignment */
            }
        }

        @media (min-width: 62em) {
            .masthead,
            .mastfoot,
            .cover-container {
                width: 42rem;
            }
        }

        .cover img{
            width: 200px;
            height: auto;
            margin:0 auto 20px auto;
        }
    </style>
</head>
<body>
<div class="site-wrapper">

    <div class="site-wrapper-inner">

        <div class="cover-container">
            <div class="inner cover">
                <img src="<?=base_url('assets/img/underconstruction.png')?>">
                <h1 class="cover-heading">En Construcción</h1>
                <p>
                    <?php if (ENVIRONMENT !== 'production') : ?>
                        <?= lang('Errors.sorryCannotFind', [], 'es')?>
                    <?php endif; ?>
                </p>
                <p class="lead">Estamos trabajando en este sitio. Volveremos con una nueva página en poco tiempo.</p>
                <p>Powered by <a href="mailto:ccdev2024@gmail.com">Code Crafters</a></p>
            </div>
            <div class="mastfoot"><div class="inner"></div></div>
        </div>

    </div>

</div>
</body>
</html>
