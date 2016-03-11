<h2>Dashboard</h2>

<p>Hello, <?= $loginUser['name'] ?>! You are logged in.</p>
<p>
<?= $this->Html->link(
    'Log out',
    ['controller' => 'Users', 'action' => 'logout'],
    ['class' => 'btn']
);?>
</p>
