<?php
/**
 * Yoast SEO Video plugin file.
 *
 * @package Yoast\VideoSEO
 */

/**
 * Presenter for presenting the upload date of the video, as a Yandex meta tag.
 */
class WPSEO_Video_Yandex_Upload_Date_Presenter extends WPSEO_Video_Abstract_Tag_Presenter {

	/**
	 * The tag key name.
	 *
	 * @var string
	 */
	protected $key = 'ya:ovs:upload_date';

	/**
	 * @inheritDoc
	 */
	public function get() {
		$post = $this->presentation->source;

		return $this->helpers->date->format( $post->post_date_gmt );
	}
}
