<!-- start settings modal -->
<div class="modal">

    <!-- start modal content -->
    <div class="modal-content">


        <div class="qrcode">
            <?= QRValidator(); ?>
        </div>

        <div class="logo">

        </div>

        <p class="heading">How to connect</p>


        <!-- configuration helper -->
        <div class="steps">
            <div class="step">
                <span>1</span>
                <span>Create personal access token</span>
            </div>

            <div class="step">
                <span>2</span>
                <span>Open Extension or Mobile Client</span>
            </div>

            <div class="step">
                <span>3</span>
                <span>Enter infos manually or scan QR code</span>
            </div>

            <div class="step">
                <span>4</span>
                <span>Validate and save connection</span>
            </div>

        </div>

        <!-- plugin settings form -->
        <form method="POST" action="options.php" class="input-group">

            <?php
            settings_fields('manawp_settings_group');
            do_settings_sections('manawp_settings_group');
            $token = get_option('manawp_token');

            ?>


            <label for="baseurl" style="color:blue; font-weight:700;">ManaWP Host</label>
            <input type="text" value="<?= get_site_url(); ?>" disabled id="baseurl" />



            <?php if (!$token): ?>
                <label for="confirm" style="color:red; font-weight:700;">Your personal access token is empty</label>
            <?php endif; ?>

            <input type="password" placeholder="mytoken123" name="manawp_token"
                value="<?php echo  esc_attr($token); ?>">


            <div class="button-group">
                <button type="submit" class="cancel-button">Save Settings</button>

            </div>
        </form>

        <!-- links -->
        <div class="links">
            <ul>
                <li><a href="https://github.com/alexanstagr/manawp"><i class="fa-brands fa-github"></i> Repo</a></li>
                <li><a href="https://github.com/alexanstagr/manawp/issues"><i class="fa-solid fa-bug"></i> Issues</a>
                </li>
                <li><a href="https://addons.mozilla.org/en-US/firefox/addon/manawp/"><i class="fa-brands fa-firefox-browser"></i> Extension</a></li>
                <li><a href="https://alexansta.gr"><i class="fa-solid fa-earth-americas"></i> Developer</a></li>
            </ul>
        </div>
    </div>
    <!-- end modal content -->
</div>
<!-- end settings modal -->