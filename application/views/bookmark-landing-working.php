<?php
/*
 * Template Name: Bookmark Landing
 *
 * Template Post Type: post, page
 *
 * The template for displaying Page/Post with No Sidebar.
 *
 * @package My Music Band
 */
$chkId = false;
if (isset($_GET['bookmark']) && strlen($_GET['bookmark']) > 0) {
    $chkId = true;
    $db_host = 'agua-prod-rds.ciyn8dhl6ltx.us-east-1.rds.amazonaws.com';
    $db_name = 'agua_prod';
    $db_user = 'dbmaster';
    $db_password = 'AguaBookmark$007';
    $db_port = '5432';

    $conn = pg_connect("host=".$db_host." port=".$db_port." dbname=".$db_name." user=".$db_user." password=".$db_password."");

    if (!$conn) {
       echo json_encode("Unable to connect to database.");die;
    }
    //$query = "SELECT tablename FROM pg_catalog.pg_tables WHERE schemaname != 'pg_catalog' AND schemaname != 'information_schema'";
    $query = '
            SELECT mb.id AS "bookmark_id", mm.*, ma.name AS "artists_name" 
            FROM "Music_bookmark" AS "mb" 
            INNER JOIN "Music_bookmark_Music" AS "mbm" ON mb.id = mbm.bookmark_id 
            INNER JOIN "Music_music" AS "mm" ON mm.id = mbm.music_id 
            INNER JOIN "Music_music_artists" AS "mma" ON mma.music_id = mm.id 
            INNER JOIN "Music_artists" AS "ma" ON mma.artists_id = ma.id 
            WHERE mb.id = '.$_GET['bookmark'].'
        ';
    $result = pg_query($conn, $query);
    while ($row = pg_fetch_assoc($result)) {
        $row['music_id'] = $row['id'];
        unset($row['created_at'],$row['updated_at'],$row['id']);
        $final = $row;
        break;
    }
}




get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="singular-content-wrap">
                <?php if ($chkId): ?>
                    <?php

                        // $titleQuery = urlencode('Diana Ross & The Supremes - Medley Of Hits');
                        $titleQuery = urlencode($final['title'].' - '.$final['artists_name']);
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'https://eu-api-v2.acrcloud.com/api/external-metadata/tracks?acr_id=&isrc=&platforms=spotify,deezer,youtube,applemusic&source_url=&query='.$titleQuery.'&include_works=0',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'GET',
                            CURLOPT_HTTPHEADER => array(
                                'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI3IiwianRpIjoiZmRjYjYxZmYzNDA4NTUyNTJlMmUwYjEyNmZhZWEzZDAxODc3ODZiMzVhMWRlNjExODFhMTUyODI1NWNjMmVmNDg2ZjFlZWMwM2M1NDEyMDYiLCJpYXQiOjE2ODAwMjc5ODEuOTYzMTgyLCJuYmYiOjE2ODAwMjc5ODEuOTYzMTg1LCJleHAiOjE5OTU2NDcxODAuNjkxMzcsInN1YiI6Ijk2MDU0Iiwic2NvcGVzIjpbInJlYWQtYnVja2V0cyIsInJlYWQtYXVkaW9zIiwibWV0YWRhdGEiLCJyZWFkLW1ldGFkYXRhIl19.Pus029AXlclnwUJBQ5r4WTLlyXDgjbiMdltlqTd-qa5Tv2CZCOmwQDC8OMXe6nR5etS5N5ZUYbArEY7Wxxoj7AqeNoWhs5WbKvr2NWOr8isd4_HS6pqjm0YpvypwQCTwbJvqR6Hd3HYrZCWLgdVCd0-vJsvFOnWjcQbugAnz8edM5cvlPHqSPPzMlVTipwI3TPLr9tIKNYtuXRrqAL-a6qG925TjSNesJtdZAOhHfss5g1QRSj8XwnJ3ED-aR1-y898ieK-OHw80xT9jwhUXIJcOuK2Vj7QolEIZ5-DTAFsTe8ITZMUR0rbU545jS3W3IAe1ry4qTwegcb0iduOGawcWjyVAH8148_rWvXcSR5rVMDAaHAmy3GrkGmL8l0JU5-20idWuqHkn-CxbhZzesls8_tQhsIOq7Tw9-N-vZT6P31KU1mO1eD90e0HYzfew8UhJfg27PCJB1YgZttBQIq_b-OaoMgsDg_EEClIaeZ-5agWwIUF-i99rFl_yHc36C0ck-PrmsKWZ13Ykj9un9pltjur7DPqCKKp3aCIJupjSBA7JMWPj_HSsY68RqEtkK_KCU8E-ivI__5Rjop-qNE4tfZYH8hNzk5fKo5HF2FxS1nV_5qdUSK918P3ArBwITcoGiXyHac57lZjGCQ5V_bCT9JbLdx3x7m1C828SNrQ'
                            ),
                        ));
                        $response = curl_exec($curl);
                        curl_close($curl);
                        $response = json_decode($response);
                        $data = false;
                        foreach ($response->data as $key => $q) {
                            if ($q->name == $final['title']) {
                                $data = $q;
                                break;
                            }
                        }
                        if ($data == false) {
                            foreach ($response->data as $key => $q) {
                                $chkSongTitle = strpos($q->name, $final['title']);
                                if ($chkSongTitle !== false) {
                                    $data = $q;
                                }
                                break;
                            }
                        }
                        /*echo '<pre>';
                        var_dump($data);
                        echo '</pre>';
                        die;*/
                    ?>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet">
                    <style>
                        .about-album {
                            padding-top: 30px;
                        }
                        .about-album .album-name {
                            text-transform: uppercase;
                            margin-top: 0;
                            font-size: 2rem;
                            margin-bottom: 16px;
                        }
                        .about-album p {
                            margin-bottom: 30px;
                        }
                        .about-album .album-information-list {
                            margin-top: 20px;
                        }  
                        .about-album .album-information-list p {
                            margin-bottom: 0;
                            font-weight: 400;
                            line-height: 1.9;
                            display: flex;
                            align-items: center;
                        }
                        .about-album .album-information-list p.nolineheight {
                            line-height: 0;
                        }
                        .about-album .album-information-list .album-info-item {
                            display: inline-block;
                            min-width: 110px;
                        }
                        .about-album .album-information-list .album-info-value {
                            margin-left: 15px;
                            display: inline-block;
                        }    
                        .album-info-value span:last-child{
                            display: none;
                        }
                        .album-info-value a{
                            margin-right: 10px;
                        }
                        .about-album .album-information-list p audio{
                            background: #f1f3f4; 
                            height: 45px;
                        }
                    </style>
                    <div class="section album-info-section section-padding">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="album-image">
                                        <img class="img-responsive" src="<?=$data->album->cover?>" alt="Album Image">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="about-album">
                                        <?php if ($data->name): ?>
                                            <h2 class="album-name"><?=$data->name?></h2>
                                        <?php endif ?>
                                        <div class="album-information-list">
                                            <?php if (isset($data->artists)): ?>
                                                <p><b class="album-info-item">Artist</b>:<span class="album-info-value">
                                                    <?php 
                                                        $c = 1;
                                                        foreach ($data->artists as $key => $artist){
                                                            echo $artist->name . '<span>,</span> ';
                                                            $c++;
                                                        }
                                                    ?>
                                                </span></p>
                                            <?php endif ?>
                                            <?php if (isset($data->album->name)): ?>
                                                <p><b class="album-info-item">Album</b>:<span class="album-info-value"><?=$data->album->name?></span></p>
                                            <?php endif ?>
                                            <?php if (isset($data->album->release_date)): ?>
                                                <p><b class="album-info-item">Release Date</b>:<span class="album-info-value"><?=$data->album->release_date?></span></p>
                                            <?php endif ?>
                                            <?php if (isset($data->label)): ?>
                                                <p><b class="album-info-item">Label</b>:<span class="album-info-value"><?=$data->label?></span></p>
                                            <?php endif ?>
                                            <p>
                                                <b class="album-info-item">Track Links</b>:
                                                <span class="album-info-value">
                                                    <?php if (isset($data->external_metadata->deezer[0]->link)): ?>
                                                        <a target="_blank" href="<?=$data->external_metadata->deezer[0]->link?>" style="color: #000;font-size: 18px;"><i class="fa-brands fa-deezer"></i></a>
                                                    <?php endif ?>
                                                    <?php if (isset($data->external_metadata->spotify[0]->link)): ?>
                                                        <a target="_blank" href="<?=$data->external_metadata->spotify[0]->link?>" style="color: #000;font-size: 18px;"><i class="fa-brands fa-spotify"></i></a>
                                                    <?php endif ?>
                                                    <?php if (isset($data->external_metadata->applemusic[0]->link)): ?>
                                                        <a target="_blank" href="<?=$data->external_metadata->applemusic[0]->link?>" style="color: #000;font-size: 18px;"><i class="fa-brands fa-apple"></i></a>
                                                    <?php endif ?>
                                                    <?php if (isset($data->external_metadata->youtube->vid)): ?>
                                                        <a target="_blank" href="https://www.youtube.com/watch?v=<?=$data->external_metadata->youtube->vid?>" style="color: #000;font-size: 18px;"><i class="fa-brands fa-youtube"></i></a>
                                                    <?php endif ?>
                                                </span>
                                            </p>
                                            <p>
                                                <b class="album-info-item">Album Links</b>:
                                                <span class="album-info-value">
                                                    <?php if (isset($data->external_metadata->deezer[0]->album->link)): ?>
                                                        <a target="_blank" href="<?=$data->external_metadata->deezer[0]->album->link?>" style="color: #000;font-size: 18px;"><i class="fa-brands fa-deezer"></i></a>
                                                    <?php endif ?>
                                                    <?php if (isset($data->external_metadata->spotify[0]->album->link)): ?>
                                                        <a target="_blank" href="<?=$data->external_metadata->spotify[0]->album->link?>" style="color: #000;font-size: 18px;"><i class="fa-brands fa-spotify"></i></a>
                                                    <?php endif ?>
                                                </span>
                                            </p>
                                            <p>
                                                <b class="album-info-item">Artists Links</b>:
                                                <span class="album-info-value">
                                                <?php foreach ($data->artists as $key => $artist): ?>
                                                    <?php if (isset($data->external_metadata->spotify[0]->artists)): ?>
                                                        <a target="_blank" href="<?=$data->external_metadata->spotify[0]->artists[$key]->link?>"><?=$artist->name?></a>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                                </span>
                                            </p>
                                            <?php if (isset($data->external_metadata->deezer[0]->preview)): ?>
                                                <p class="nolineheight">
                                                    <b class="album-info-item">Deezer</b>:
                                                    <span class="album-info-value">
                                                        <audio controls autoplay>
                                                            <source src="<?=$data->external_metadata->deezer[0]->preview?>" type="audio/mp3">
                                                        </audio>
                                                    </span>
                                                </p>
                                            <?php endif ?>
                                            <?php if (isset($data->external_metadata->spotify[0]->preview)): ?>
                                                <p class="nolineheight mt-3">
                                                    <b class="album-info-item">Spotify</b>:
                                                    <span class="album-info-value">
                                                        <audio controls autoplay>
                                                            <source src="<?=$data->external_metadata->spotify[0]->preview?>" type="audio/mp3">
                                                        </audio>
                                                    </span>
                                                </p>
                                            <?php endif ?>
                                            <?php if (isset($data->external_metadata->applemusic[0]->preview)): ?>
                                                <p class="nolineheight mt-3">
                                                    <b class="album-info-item">Apple Music</b>:
                                                    <span class="album-info-value">
                                                        <audio controls autoplay>
                                                            <source src="<?=$data->external_metadata->applemusic[0]->preview?>" type="audio/mp3">
                                                        </audio>
                                                    </span>
                                                </p>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if (isset($data->external_metadata->youtube->vid)): ?>
                        <iframe style="width: 100%; height: 400px" src="https://www.youtube.com/watch?v=<?=$data->external_metadata->youtube->vid?>"></iframe>
                    <?php endif ?>
                <?php else: ?>
                    <style>
                        .partners{
                            display: flex;
                            flex-direction: row;
                            align-items: center;
                            justify-content: center;
                        }
                        .partners .partner-contain{
                            margin-right: 20px;
                        }
                        .partners .partner-contain img{
                            width: 100%;
                        }
                    </style>
                    <?php
                    while ( have_posts() ) : the_post();

                        get_template_part( 'template-parts/content/content', 'page' );

                        get_template_part( 'template-parts/content/content', 'comment' );

                    endwhile; // End of the loop.
                    ?>
                <?php endif ?>
            </div> <!-- singular-content-wrap -->
        </main><!-- #main -->
    </div><!-- #primary -->
<?php
get_footer();


