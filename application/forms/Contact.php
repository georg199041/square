<?php

class Application_Form_Contact extends Zend_Form
{
	public function init()
	{	//�������������� �����
		$this->setAction('/contact/index')
			 ->setMethod('post');
		
		//������� ��������� ���� ��� �����
		$name = new Zend_Form_Element_Text('name');
		$name->setLabel('���')
			 ->setOptions(array('size' => '35'))
			 ->setRequired(true)
			 ->addValidator('NotEmpty', true)
			 ->addValidator('Alpha', true)
			 ->addFilter('HtmlEntities')
			 ->addFilter('StringTrim');
		
		//������� ��������� ���� ��� ����� ������ �����
		$email = new Zend_Form_Element_Text('email');
		$email->setLabel('E-mail');
		$email->setOptions(array('size' => '50'))
			  ->setRequired(true)
			  ->addValidator('NotEmpty', true)
			  ->addValidator('EmailAddress', true)
			  ->addFilter('HtmlEntities')
			  ->addFilter(StringToLower)
			  ->addFilter('StringTrim');
			  
		//������� ��������� ���� ��� ���������
		$message = new Zend_Form_Element_Textarea('message'); 
		$message->setLabel('���������')
				->setOptions(array('rows' => '8','cols' => '40'))
				->setRequired(true)
				->addValidator('NoEmpty', true)
				->addFilter('HtmlEntities')
				->addFilter('StringTrim');
		
		//������� CAPTCHA
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
		$captcha->setLabel('��� �������������');
		
		//������� ������ ��������
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('���������')
			   ->setOptions(array('class' => 'submit'));
		
		//��������� �������� � �����
		$this->addElement($name)
			 ->addElement($email)
			 ->addElement($message)
			 ->addElement($captcha)
			 ->addElement($submit);
	}
}