<!doctype html>
<html>
<head>
    <base href='/'>
    <meta charset="utf-8"/>
    <link rel="manifest" href="/intranet/manifest.json">
    <meta name="theme-color" content="#2bbbad">
    <link rel="apple-touch-icon" sizes="76x76"
          href="http://drsgroup.com.br/2016/wp-content/themes/drsgroup/assets/images/logo-drs-group.jpg"/>
    <link rel="icon" type="image/png"
          href="http://drsgroup.com.br/2016/wp-content/themes/drsgroup/assets/images/logo-drs-group.jpg"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <meta name="description" content="Drs Portal Intranet.">
    <meta name="author" content="DRS Tecnologia">

    <title>DRS Portal Intranet</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet"/>
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">


    <link rel="stylesheet" href="styles.c2410dc2aaf98c7d1e95.css">
</head>
<body>
<app-root>
</app-root>
<noscript>
    <h3 style="color:#3f51b5; font-family: Helvetica; margin: 2rem;">
        Aplicativo indisponível.
    </h3>
</noscript>

<script>
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/intranet/service-worker.js')
            .then(function (registration) {
                console.log('ServiceWorker registration successful with scope: ', registration.scope);
            })
            .catch(function (err) {
                console.log('SerivceWorker registration failed: ', err);
            });
    }
</script>
<script type="text/javascript" src="runtime.f9ec9dee1b7e2bc73d6c.js"></script>
<script type="text/javascript" src="polyfills.f8f8239de0fe580b5c3d.js"></script>
<script type="text/javascript" src="scripts.2cc9101aa9ed72da1ec4.js"></script>
<script type="text/javascript" src="main.9a8362625b88a4c86a65.js"></script>
</body>


</html>
