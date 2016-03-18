
<?= $this->Form->postLink(
    'Login with GitHub',
    ['controller' => 'Users', 'action' => 'login'],
    ['class' => 'btn']
) ?>
