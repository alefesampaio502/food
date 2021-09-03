<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;

class Filters extends BaseConfig
{
	/**
	 * Configures aliases for Filter classes to
	 * make reading things nicer and simpler.
	 *
	 * @var array
	 */
	public $aliases = [
		'csrf'     => CSRF::class,
		'toolbar'  => DebugToolbar::class,
		'honeypot' => Honeypot::class,
		'login' => \App\Filters\LoginFilter::class, //Filtro de Login para Aplicação geral//
		'admin' => \App\Filters\AdminFilter::class, //Filtro de Admin para Aplicação geral//
		'visitante' => \App\Filters\VisitanteFilter::class, //Filtro visitante geral//
		'throttle' => \App\Filters\ThrottleFilter::class, //previne ataque de força bruta por ip
	];

	/**
	 * List of filter aliases that are always
	 * applied before and after every request.
	 *
	 * @var array
	 */
	public $globals = [
		'before' => [
			// 'honeypot',
			 'csrf',
		],
		'after'  => [
			'toolbar',
			// 'honeypot',
		],
	];

	/**
	 * List of filter aliases that works on a
	 * particular HTTP method (GET, POST, etc.).
	 *
	 * Example:
	 * 'post' => ['csrf', 'throttle']
	 *
	 * @var array
	 */
	 public $methods = [
    // 'post' => ['throttle',]
 ];

	/**
	 * List of filter aliases that should run on any
	 * before or after URI patterns.
	 *
	 * Example:
	 * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
	 *
	 * @var array
	 */
	public $filters = [
		'login' => [
			'before' =>[
			'admin/*',// Todos os controller que estão dentro do namespace 'Admin' só serão acessado após o Login
		]
	],
	'admin' => [
		'before' =>[
		'admin/*',// Todos os controller que estão dentro do namespace 'Admin' só serão acessado por um administrador.
	]
],
];
}
