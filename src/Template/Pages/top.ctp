<h1>StreakKeeper</h1>

<p>Don't stop your GitHub streak.</p>

<?php if (!$loginUser): ?>
    <p>
    <?= $this->Form->postLink(
        'Login with GitHub',
        ['controller' => 'Users', 'action' => 'login'],
        ['class' => 'btn']
    ) ?>
    </p>
<?php else: ?>
    <p>Hello, <?= $loginUser['name'] ?>! You are logged in.</p>
    <p>
    <?= $this->Html->link(
        'Log out',
        ['controller' => 'Users', 'action' => 'logout'],
        ['class' => 'btn']
    );?>
    </p>
<?php endif; ?>
