<?php

class Application_Form_Contact extends Zend_Form
{
	public function init()
	{	//инициализируем форму
		$this->setAction('/contact/index')
			 ->setMethod('post');
		
		//создаем текстовое поле для имени
		$name = new Zend_Form_Element_Text('name');
		$name->setLabel('Имя')
			 ->setOptions(array('size' => '35'))
			 ->setRequired(true)
			 ->addValidator('NotEmpty', true)
			 ->addValidator('Alpha', true)
			 ->addFilter('HtmlEntities')
			 ->addFilter('StringTrim');
		
		//создаем текстовое поле для ввода адреса почты
		$email = new Zend_Form_Element_Text('email');
		$email->setLabel('E-mail');
		$email->setOptions(array('size' => '50'))
			  ->setRequired(true)
			  ->addValidator('NotEmpty', true)
			  ->addValidator('EmailAddress', true)
			  ->addFilter('HtmlEntities')
			  ->addFilter(StringToLower)
			  ->addFilter('StringTrim');
			  
		//создаем текстовое поле для сообщения
		$message = new Zend_Form_Element_Textarea('message'); 
		$message->setLabel('Сообщение')
				->setOptions(array('rows' => '8','cols' => '40'))
				->setRequired(true)
				->addValidator('NoEmpty', true)
				->addFilter('HtmlEntities')
				->addFilter('StringTrim');
		
		//создаем CAPTCHA
		$captcha = new Zend_Form_Element_Captcha('captcha', array(
			'captcha' => array(
				'captcha'  => 'Image',
				'worldLen' => 6,
				'timeout'  => 300,
				'width'    => 300,
				'height' => 100,
				'imgUrl' => '/captcha',
				'imgDir' => APPLICATION_PATH . '/../public/captcha',
				'font' => 'arial,tahoma',							
			)
		));
		$captcha->setLabel('Код подтверждения');
		
		//создаем кнопку отправки
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Отправить')
			   ->setOptions(array('class' => 'submit'));
		
		//добавляем элементы к форме
		$this->addElement($name)
			 ->addElement($email)
			 ->addElement($message)
			 ->addElement($captcha)
			 ->addElement($submit);
	}
}