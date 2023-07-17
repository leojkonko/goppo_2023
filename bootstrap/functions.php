<?php

/*
|--------------------------------------------------------------------------
| Funções úteis
|--------------------------------------------------------------------------
*/

use App\Services\LanguagesService;
use App\Services\ScreensService;
use App\Services\LogsService;
use App\Models\Language;

/**
 * Deixa somente caracteres numéricos
 */
function onlyNumbers(string|int|null $str): string
{
    return preg_replace("/[^0-9]/", '', $str);
}

/**
 * Deixa somente caracteres numéricos
 */
function only_numbers(string|int|null $str): string
{
    return onlyNumbers($str);
}

/**
 * number_format padrao
 */
function nf(float|int|string $valor): string
{
	return number_format($valor, 2, ',', '.');
}

/**
 * limita os caracteres de uma string
 */
function max_c($str, $max = 999999): string
{
	if(!is_string($str))
		$str = strval($str);
	
	return substr($str, 0, $max);
}

/**
 * Função para facilitar o acesso ao serviço de idiomas
 */
function languages() : LanguagesService
{
	return app(LanguagesService::class);
}

/**
 * Função para facilitar o acesso ao serviço de screens
 */
function screens() : ScreensService
{
	return app(ScreensService::class);
}

/**
 * Função para facilitar o acesso ao serviço de logs da restrita
 */
function logsRestrita() : LogsService
{
	return app(LogsService::class);
}

/**
 * Gera uma URL usando o idioma atual
 */
function route_lang(string $name, array $parameters = [], bool $absolute = true)
{
	$language = languages()->getCurrentLanguage();
	return route_for_lang($name, $language, $parameters, $absolute);
}

/**
 * Gera uma URL usando o idioma passado por parâmetro
 */
function route_for_lang(string $name, Language|string $language, array $parameters = [], bool $absolute = true)
{
	if (is_string($language)) {
		$code = $language;
		$language = languages()->getByCode($code);

		if (!$language) {
			throw new \Exception("Não existe idioma com o código '{$code}'");
		}
	}

	// rotas pt-BR não usam o prefixo
	if ($language->code !== 'pt') {
		$name = "{$language->code}.$name";
	}

	return route($name, $parameters, $absolute);
}
