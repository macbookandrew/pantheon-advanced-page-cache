<?php
/**
 * Tests for the Purger class.
 *
 * @package Pantheon_Integrated_CDN
 */

/**
 * Tests for the Purger class.
 */
class Test_Purger extends Pantheon_Integrated_CDN_Testcase {

	/**
	 * Verify calling clean_post_cache() clears expected keys.
	 */
	public function test_clean_post_cache() {
		clean_post_cache( $this->post_id1 );
		$this->assertClearedKeys( array(
			'home',
			'front',
			'post-' . $this->post_id1,
			'user-' . $this->user_id1,
		) );
		$this->assertPurgedURIs( array(
			'/',
			'/2016/',
			'/2016/10/',
			'/2016/10/14/',
			'/2016/10/14/first-post/',
			'/author/first-user/',
			'/first-page/',
			'/category/uncategorized/',
			'/tag/second-tag/',
		) );
	}

	/**
	 * Verify calling wp_delete_post() clears expected keys.
	 */
	public function test_wp_delete_post_force() {
		wp_delete_post( $this->post_id1, true );
		$this->assertClearedKeys( array(
			'home',
			'front',
			'post-' . $this->post_id1,
		) );
		$this->assertPurgedURIs( array(
			'/',
			'/2016/',
			'/2016/10/',
			'/2016/10/14/',
			'/2016/10/14/first-post/',
			'/author/first-user/',
			'/category/uncategorized/',
			'/tag/second-tag/',
		) );
	}

	/**
	 * Verify calling clean_term_cache() clears expected keys.
	 */
	public function test_clean_term_cache() {
		clean_term_cache( $this->tag_id1 );
		$this->assertClearedKeys( array(
			'term-' . $this->tag_id1,
		) );
		$this->assertPurgedURIs( array(
			'/tag/first-tag/',
		) );
	}

	/**
	 * Verify calling clean_user_cache() clears expected keys.
	 */
	public function test_clean_user_cache() {
		clean_user_cache( $this->user_id1 );
		$this->assertClearedKeys( array(
			'user-' . $this->user_id1,
		) );
		$this->assertPurgedURIs( array(
			'/',
			'/2016/',
			'/2016/10/',
			'/2016/10/14/',
			'/2016/10/14/first-post/',
			'/category/uncategorized/',
			'/first-page/',
			'/author/first-user/',
			'/tag/second-tag/',
		) );
	}

}
