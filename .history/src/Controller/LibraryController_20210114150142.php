<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Book;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LibraryController extends AbstractController
{

    /* private $logger;

    public function __construct(LoggerInterface $logger) //Lo comentamos porque si ahora lo llamamos dentro d elos paramentros de la funcion 
    {
        $this->logger = $logger;
    } */

    /**
     * 
     * @Route("/library/list", name="library_list")
     */
    public function list(Request $request, LoggerInterface $logger) //Los controladores pueden recibir por parametros varios objetos como "Request" y tambien pueden recibir servicio, es decir clases de php. EStos estan dentro de los containers.
    //Por ejemplo al container se le puede pedir el servicio para Logggear. A esto se le llama inyeccion de dependencias y es la forma que tiene symfony de proveernos de funcionalidades extras.
    //Desde la consola si escribimos el comando bin/console debug:container nos da la lista de los servicios a los cuales podemos acceder.
    //Estos servicios se encuentran en la carpeta config/services.yaml
    {
        $title = $request -> get('title'); //Recuperar parametros por la query.
        /* $this->logger->info('List action called'); */ //En vez de llamarlo asi, que es cuando llamamos al servicio por medio del construtor.
        $logger->info('List action called 2'); //Lo vamos a llamar asi porque ahora al servicio lo llamamos desde los parametros de la funcion que estabamos usando. Esto solo se puede hacer desde la carpeta Controller, ya que asi esta configurado, en otrass carpetas hay que hacerlo mediante el constructor.
        $response = new JsonResponse();
        $response->setData([
            'success' => true,
            'data' => [
                [
                    'id' => 1,
                    'title' => 'Hacia rutas salvajes'
                ],
                [
                    'id' => 2,
                    'title' => 'El nombre del viento'
                ],
                [
                    'id' => 3,
                    'title' => $title
                ]
            ]
        ]);
        return $response;
    }

    public function createBook(Request $request, EntityManagerInterface, $em) //Symfony usa interfaces para asi podemos cambiar de servicio doctrine con mayor facilidad, en vez de estar haciendo una clase por cada servicio
    {
        $book = new Book();  //Book es una entidad pero para yo poder insertarla en la base de datos tengo que acudir a un servicio doctrine  llamado EntityManager.
        $book->setTitle('Hacia rutas salvajes');
    }
}

?>