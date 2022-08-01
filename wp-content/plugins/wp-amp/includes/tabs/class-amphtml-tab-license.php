<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
if ( ! class_exists( 'AMPHTML_Tab_License' ) ) {

    class AMPHTML_Tab_License extends AMPHTML_Tab_Abstract {

        public function get_fields() {
            return array(
                array(
                    'id'                    => 'license_name',
                    'title'                 => __( "Codecanyon user name", 'amphtml' ),
                    'placeholder'           => 'johnsmith123',
                    'default'               => '',
                    'display_callback'      => array( $this, 'display_text_field' ),
                    'display_callback_args' => array( 'id' => 'license_name' ),
                ),
                array(
                    'id'                    => 'license_code',
                    'title'                 => __( 'Enter your License', 'amphtml' ),
                    'placeholder'           => 'a1b2c3d4-e5f6-g7h8-i9g0-k1l2m3n4o5p6',
                    'default'               => '',
                    'display_callback'      => array( $this, 'display_text_field' ),
                    'display_callback_args' => array( 'id' => 'license_code' ),
                ),
            );
        }

        public function get_submit() {
            $check = amp_check_license();
            if ( empty( $check[ 'status' ] ) ) {
                ?>
                <p class="submit">
                    <input type="submit" name="submit" id="submit" class="button button-primary"
                           value="<?php echo __( 'Save Changes', 'amphtml' ); ?>">
                <?php do_action( 'get_tab_submit_button', $this ); ?>
                </p>
                <?php
            } else {
                ?>
                <input type="submit" name="amphtml_deactivate_license" value="<?php echo __( 'Deactivate', 'amphtml' ); ?>" class="button button-primary" id="deactivate_license"/>
                <?php if ( $this->is_update() ) {
                    ?>
                    <input type="submit" value="<?php echo __( 'Update', 'amphtml' ); ?>" class="button button-primary" id="update_license"/>
                    <?php
                }
                do_action( 'amphtml_license_button' );
            }
        }

        public function is_update() {
            global $license_box_api;
            $result = $license_box_api->check_update();
            return $result[ 'status' ];
        }

    }

}