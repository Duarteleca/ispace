<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Pages_c/view';


$route['Sala_admin']= 'Privado_c/mostra_salas';
$route['Inserir_sala']= 'Privado_c/inserir_sala';
$route['Perfil']= 'Privado_c/atualizar_perfil';
$route['Users']= 'Privado_c/users';
$route['Equipamento_admin']= 'Privado_c/mostra_equipamento';
$route['Inserir_equipamento']= 'Privado_c/inserir_equipamento';
$route['Fazer_requisicao']= 'Privado_c/fazer_requisicao';
$route['Requisicao']= 'Privado_c/mostra_salas_requisicao';
$route['Equipamento_requisito']= 'Privado_c/mostra_equipamento_requisitar/$1';
$route['adicionar_Equipamento_Requisito']= 'Privado_c/adicionar_Equipamento_Requisito';
$route['Requisicoes_equipamentos_admin']= 'Privado_c/mostra_Requisicoes_Equipamentos_admin';
$route['Requisicoes_salas_admin']= 'Privado_c/mostra_Requisicoes_Salas_admin';
$route['Requisicoes_equipamentos_user']= 'Privado_c/mostra_Requisicoes_Equipamentos_user2';
$route['users']= 'Privado_c/users';

$route['Salas']= 'Publico_c/mostra_salas';
$route['Registo']= 'Publico_c/registar_user';
$route['Contacto']= 'Publico_c/Contacto';
$route['Recuperar']= 'Publico_c/Recuperar_pass';
$route['Equipamento']= 'Publico_c/mostra_equipamento';
$route['home']= 'Publico_c/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
// $route['(:any)'] = 'Pages/view/$1';

