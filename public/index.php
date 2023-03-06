<?php

/**
 * File for display page with actual info about snapshot
 *
 * @author Mykhailo YATSYSHYN <mykhailo.yatsyshyn@mirko.in.ua>
 */

require_once __DIR__."/../vendor/autoload.php";

$URI = 'http://65.109.3.210/snapshot/latest.tar.lz4';

$snapshot = new \App\Snapshot();
$snapshot->load();

?>

<html>
<head>
    <title>Nolus Protocol - snapshot</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="./style.css" rel="stylesheet">
</head>

<body>
<div class="container">
    <div class="logo">
        <svg id="Component_341_1" data-name="Component 341 – 1" xmlns="http://www.w3.org/2000/svg" width="125.46" height="31.923" viewBox="0 0 125.46 31.923">
            <g id="Group_198" data-name="Group 198">
                <path id="Path_19" data-name="Path 19" d="M1192.605,756.228a15.962,15.962,0,1,0,15.962,15.962A15.962,15.962,0,0,0,1192.605,756.228Zm5.581,23.942h-11.161a2.4,2.4,0,0,1-2.4-2.4V766.609a2.4,2.4,0,0,1,2.4-2.4h11.161a2.4,2.4,0,0,1,2.4,2.4V777.77A2.4,2.4,0,0,1,1198.186,780.17Z" transform="translate(-1176.644 -756.228)" fill="#f50"/>
            </g>
            <path id="Path_309" data-name="Path 309" d="M4.76-17.3H8.479v-8.644c0-3.295,1.925-5.415,4.7-5.415,2.577,0,4.143,1.859,4.143,4.828V-17.3h3.719v-9.59c0-4.795-2.707-7.861-7.176-7.861a7.5,7.5,0,0,0-5.806,2.479l-.391-2.055H4.76Zm28.607.424c5.382,0,9.2-3.686,9.2-8.938,0-5.219-3.816-8.938-9.2-8.938-5.415,0-9.231,3.719-9.231,8.938C24.136-20.564,27.952-16.878,33.367-16.878Zm-5.545-8.938a5.309,5.309,0,0,1,5.545-5.545,5.3,5.3,0,0,1,5.513,5.545,5.3,5.3,0,0,1-5.513,5.545A5.309,5.309,0,0,1,27.822-25.816Zm18.2,8.514h3.719V-41.44H46.023Zm15.2.424a7.249,7.249,0,0,0,5.708-2.479l.424,2.055h2.9V-34.329H66.54v8.644c0,3.295-1.892,5.415-4.632,5.415-2.544,0-4.077-1.859-4.077-4.828v-9.231H54.112v9.59C54.112-19.944,56.754-16.878,61.223-16.878Zm20.126,0c4.338,0,7.111-1.957,7.111-5.023,0-2.74-2.185-4.567-6.459-5.382-3.262-.652-4.273-1.24-4.273-2.446,0-1.272,1.174-2.022,3.164-2.022,2.185,0,3.49.881,3.621,2.446h3.653c-.228-3.458-2.9-5.447-7.274-5.447-4.306,0-6.817,1.827-6.817,4.991,0,2.773,2.022,4.436,6.393,5.154,3,.522,4.338,1.337,4.338,2.642,0,1.272-1.272,2.022-3.425,2.022-2.446,0-3.914-1.044-3.979-2.773H73.749C73.749-19.194,76.782-16.878,81.349-16.878Z" transform="translate(37 43.439)" fill="#072d63"/>
        </svg>
        <div class="">
            <h2 class="h2">Nolus Protocol - snapshot</h2>
        </div>
    </div>

    <div class="">
        <table class="table table-dark">
            <thead>
            <tr>
                <td>Blocks</td>
                <td>Time update</td>
                <td>Size</td>
                <td>Download</td>
                <td>Link</td>
            </tr>
            </thead>
            <tbody class="table-secondary">
            <tr>
                <td><?php echo $snapshot->getBlocks(); ?></td>
                <td><?php echo $snapshot->getUpdateTime()->format('d-m-Y H:i'); ?></td>
                <td><?php echo number_format($snapshot->getSize() / 1024 / 1024, 2); ?> MB</td>
                <td><a href="<?php echo $URI; ?>" class="btn btn-sm btn-dark">Download</a> </td>
                <td><?php echo $URI; ?></td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="context">
        <div class="card">
            <div class="card-body">
                <h3>Instructions</h3>
                <hr />

                <h3>1. Stop the service and reset the data</h3>

                <div class="card text-bg-dark">
                    <div class="card-body">
                        sudo systemctl stop nolusd <br />
                        cp $HOME/.nolus/data/priv_validator_state.json $HOME/.nolus/priv_validator_state.json.backup <br />
                        rm -rf $HOME/.nolus/data
                    </div>
                </div>
                <hr />

                <h3>2. Download latest snapshot</h3>

                <div class="card text-bg-dark">
                    <div class="card-body">
                        curl -L <?php echo $URI; ?>" | tar -Ilz4 -xf - -C $HOME/.nolus <br />
                        mv $HOME/.nolus/priv_validator_state.json.backup $HOME/.nolus/data/priv_validator_state.json
                    </div>
                </div>
                <hr />


                <h3>3. Restart the service and check the log</h3>
                <div class="card text-bg-dark">
                    <div class="card-body">
                        sudo systemctl start nolusd && sudo journalctl -u nolusd -f --no-hostname -o cat
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</body>
</html>

