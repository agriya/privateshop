<?php if ($this->Paginator->params['paging'][Inflector::singularize($this->name)]['pageCount'] > 1):  ?>
<div class="paging clearfix">
<?php
$this->Paginator->options(array(
    'url' => array_merge(array(
        'controller' => $this->request->params['controller'],
        'action' => $this->request->params['action'],
    ) , $this->request->params['pass'], $this->request->params['named'])
));

echo $this->Paginator->prev( __l('Prev') , array(
    'class' => 'prev',
    'escape' => false
) , null, array(
    'tag' => 'span',
    'escape' => false,
    'class' => 'prev'
)), "\n";
$options = array(
    'modulus' => 2,
    'first' => 3,
	'last' => 3,
	'ellipsis' => '<span class="ellipsis">&hellip;.</span>',
    'separator' => " \n",
    'before' => null,
    'after' => null,
    'escape' => false
);
if(isset($page) && $page == 'home')
{
  $options['first'] = 0;
  $options['last'] = 0;
}
echo $this->Paginator->numbers($options);
echo $this->Paginator->next(__l('Next'), array(
    'class' => 'next',
    'escape' => false
) , null, array(
    'tag' => 'span',
    'escape' => false,
    'class' => 'next'
)), "\n";
?>
</div>
<?php endif; ?>
