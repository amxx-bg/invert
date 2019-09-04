<?php
/**
 *
 * Dark Mode extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2013 phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace evilsystem\invert\event;

/**
 * Event listener
 */
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	/** @var \phpbb\template\template */
	protected $template;
	/** @var \phpbb\user $user */
	protected $user;


	/**
	 * Constructor
	 *
	 * @param \phpbb\template\template	$template Template object
	 * @param \phpbb\user			$user User object
	 * @return \evilsystem\invert\event\listener
	 * @access public
	 */
	public function __construct(\phpbb\template\template $template, \phpbb\user $user)
	{
		$this->template = $template;
		$this->user = $user;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.page_header'		=> 'invertTheme',
		);
	}
	
	public function invertTheme($event)
	{
		$isInverted = request_var('inverted','',false,true);
		if ($isInverted)
		{
			$themeClassic = "";
			$themeInvert = "display: none;";
			$class = "inverted";
		}
		else
		{
			$themeClassic = "display: none;";
			$themeInvert = "";
			$class = "";
		}
		
		$this->template->append_var('BODY_CLASS', $class);
		$this->template->append_var('INVERT_STYLE', $themeInvert);
		$this->template->append_var('CLASSIC_STYLE', $themeClassic);
    
		$this->user->add_lang_ext('evilsystem/invert', 'invert');
		$this->template->assign_var('INVERT_MESSAGE'	, $this->user->lang['INVERTED_THEME']);
		$this->template->assign_var('CLASSIC_MESSAGE'	, $this->user->lang['CLASSIC_THEME']);
	}
}
