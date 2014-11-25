<?php
class Tests_Counter extends WP_UnitTestCase {
	private $counter;

//	This is function allows us to perform any required setUp tasks (e.g. clear cache / load prerequisite plugins...etc)
	public function setUp() {
		parent::setUp();
		/* Get an instance of our plugin */
		$this->counter = new CommentCounter;
	}

	/* A simple test */
	public function test_simple(){
		$a = true;
		$this->assertTrue($a);
	}


//	This is function allows us to perform any required cleanup tasks
	public function tearDown() {
		parent::tearDown();
	}


}