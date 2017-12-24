<?php
namespace tests\unit;

use app\models\User;
use tests\TestCase;
use Yii;

class UserTest extends TestCase {

	public function setUp() {

		parent::setUp();

		User::deleteAll();
	}

	public function testValidateExistedValues() {

		Yii::$app->db->createCommand()
			->insert(User::tableName(),[
				'username'=>'user',
				'email'=>'user@email.com'
			])->execute();

		$user = new User([
			'username'=>'user',
			'email'=>'user@email.com',
		]);

		$this->assertFalse($user->validate(), 'model is not valid');
		$this->assertArrayHasKey('username', $user->getErrors(), 'check existed username error');
		$this->assertArrayHasKey('email', $user->getErrors(), 'check existed email error');
	}


	public function testSaveIntoDatabase() {

		$user = new User([
			'username'=>'TestUsername',
			'email'=>'test@email.com',
		]);

		$this->assertTrue($user->save(), 'model is saved');
	}


	public function testValidateWrongValues() {

		$user = new User([
			'username'=>'Wrong % Username',
			'email'=>'wrong_email',
		]);

		$this->assertFalse($user->validate(),'validate incorrect username and email');
		$this->assertArrayHasKey('username', $user->getErrors(), 'check incorrect username error');
		$this->assertArrayHasKey('email', $user->getErrors(), 'check incorrect email error');
	}


	public function testValidateCorrectValues() {

		$user = new User([
			'username'=>'CorrectUsername',
			'email'=>'correct@email.com',
		]);

		$this->assertTrue($user->validate(),'correct model is valid');
	}


	public function testValidateEmptyValues() {

		$user = new User();

		$this->assertFalse($user->validate(), 'model is not valid');
		$this->assertArrayHasKey('username', $user->getErrors(), 'check empty username error');
		$this->assertArrayHasKey('email', $user->getErrors(), 'check empty email error');
	}
}