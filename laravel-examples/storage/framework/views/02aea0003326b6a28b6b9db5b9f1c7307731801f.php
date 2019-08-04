<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <script> window.Laravel = { csrfToken: 'csrf_token() ' } </script>

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">

    </head>
    <body>

        <div id="app">
            <Reddit></Reddit>
        </div>

        <script src="<?php echo e(asset('js/app.js')); ?>"></script>

    </body>

</html>
<?php /**PATH C:\Users\jerem\workspaces\php_web_scrapers\laravel-goutte-example\resources\views/reddit.blade.php ENDPATH**/ ?>