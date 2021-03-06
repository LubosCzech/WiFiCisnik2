<?php
/**
 * Created by PhpStorm.
 * User: lubossvetik
 * Date: 22.10.15
 * Time: 13:21
 */
namespace App\Controller\Component;

use Cake\Controller\Component\PaginatorComponent;
use Cake\Controller\Component;
use Cake\Datasource\RepositoryInterface;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\Query;
use Cake\ORM\Table;

class CustomPaginatorComponent extends PaginatorComponent{
    function paginate($object, array $settings = [])
    {
        if ($object instanceof Query) {
            $query = $object;
            $object = $query->repository();
        }

        $alias = $object->alias();
        $options = $this->mergeOptions($alias, $settings);
        $options = $this->validateSort($object, $options);
        $options = $this->checkLimit($options);

        $options += ['page' => 1];
        $options['page'] = (int)$options['page'] < 1 ? 1 : (int)$options['page'];
        if(isset($options['pageUser'])){
            $options['page']=$options['pageUser'];
        }
        list($finder, $options) = $this->_extractFinder($options);

        if (empty($query)) {
            $query = $object->find($finder, $options);
        } else {
            $query->applyOptions($options);
        }

        $results = $query->all();
        $numResults = count($results);
        $count = $numResults ? $query->count() : 0;

        $defaults = $this->getDefaults($alias, $settings);
        unset($defaults[0]);

        $page = $options['page'];
        $limit = $options['limit'];
        $pageCount = (int)ceil($count / $limit);
        $requestedPage = $page;
        $page = max(min($page, $pageCount), 1);
        $request = $this->_registry->getController()->request;

        $order = (array)$options['order'];
        $sortDefault = $directionDefault = false;
        if (!empty($defaults['order']) && count($defaults['order']) == 1) {
            $sortDefault = key($defaults['order']);
            $directionDefault = current($defaults['order']);
        }

        $paging = [
            'finder' => $finder,
            'page' => $page,
            'current' => $numResults,
            'count' => $count,
            'perPage' => $limit,
            'prevPage' => ($page > 1),
            'nextPage' => ($count > ($page * $limit)),
            'pageCount' => $pageCount,
            'sort' => key($order),
            'direction' => current($order),
            'limit' => $defaults['limit'] != $limit ? $limit : null,
            'sortDefault' => $sortDefault,
            'directionDefault' => $directionDefault
        ];

        if (!isset($request['paging'])) {
            $request['paging'] = [];
        }
        $request['paging'] = [$alias => $paging] + (array)$request['paging'];

        if ($requestedPage > $page) {
            throw new NotFoundException();
        }

        return $results;
    }
}
?>