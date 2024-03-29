<?php
/**
 * Yoast SEO Video plugin file.
 *
 * @package Yoast\VideoSEO
 */

/**
 * Presenter for presenting whether the video contains adult material, as a Yandex meta tag.
 */
class WPSEO_Video_Yandex_Adult_Presenter extends WPSEO_Video_Abstract_Tag_Presenter {

	/**
	 * The tag key name.
	 *
	 * @var string
	 */
	protected $key = 'ya:ovs:adult';

	/**
	 * @inheritDoc
	 */
	public function get() {
		$post = $this->presentation->source;
		if ( WPSEO_Video_Utils::is_video_family_friendly( $post->ID ) === false ) {
			return 'true';
		}
		return 'false';
	}
}
