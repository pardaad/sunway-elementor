<?php
if (!defined('ABSPATH')) {
	exit;
}

class SunWay_Action_After_Submit extends \ElementorPro\Modules\Forms\Classes\Action_Base
{
	public function get_name()
	{
		return 'sunway';
	}

	public function get_label()
	{
		return esc_html__('پردازش با سان‌وی', 'sunway');
	}

	public function register_settings_section($widget)
	{
		$widget->start_controls_section(
			'section_sunway',
			[
				'label' => esc_html__('پردازش با سان‌وی', 'sunway'),
				'condition' => [
					'submit_actions' => $this->get_name(),
				],
			]
		);

		$widget->add_control(
			'sunway_message',
			[
				'label' => esc_html__('متن پیامک ارسالی', 'sunway'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
			]
		);

		$widget->add_control(
			'sunway_reciever',
			[
				'label' => esc_html__('برچسب فیلد شماره موبایل گیرنده', 'sunway'),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$widget->add_control(
			'sunway_sender',
			[
				'label' => esc_html__('شماره فرستنده', 'sunway'),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$widget->add_control(
			'sunway_username',
			[
				'label' => esc_html__('نام کاربری پنل', 'sunway'),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$widget->add_control(
			'sunway_password',
			[
				'label' => esc_html__('رمز عبور پنل', 'sunway'),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$widget->end_controls_section();
	}

	public function run($record, $ajax_handler)
	{
		$to			= $record->get_form_settings('sunway_reciever');
		$message 	= $record->get_form_settings('sunway_message');
		$from 		= $record->get_form_settings('sunway_sender');
		$username 	= $record->get_form_settings('sunway_username');
		$password 	= $record->get_form_settings('sunway_password');
		$form_data 		= $record->get_formatted_data();
		$to = $form_data[$to];
		$url = 'https://sms.sunwaysms.com/smsws/HttpService.ashx?service=SendArray&username=' . $username . '&password=' . $password . '&message=' . $message . '&from=' . $from . '&to=' . $to;
		$send_sms = wp_safe_remote_post($url);
		if (is_wp_error($send_sms)) {
			$error_message = $send_sms->get_error_message();
			echo "Something went wrong: $error_message";
		}
	}

	public function on_export($element)
	{
		unset(
			$element['sunway_message'],
			$element['sunway_reciever'],
			$element['sunway_sender'],
			$element['sunway_username'],
			$element['sunway_password']
		);
		return $element;
	}
}
