<?php

namespace Aujicini\Moderation\Test;

class BannableTest extends TestCase
{
    /**
     * @test
     */
    public function user_is_banned()
    {
        $user = User::find(1);
        $this->assertTrue($user->canBan());
        $this->assertTrue($user->bannable());
        $this->assertTrue(!$user->isBanned());
        $user->ban();
        $this->assertTrue($user->isBanned());
        $user->unban();
        $this->assertTrue(!$user->isBanned());
        $this->assertNull($user->ipban()->ip_address);
        $user->ban();
        $this->assertNull($user->ipban()->ip_address);
        $user->unban();
        $this->assertNull($user->ipban()->ip_address);
        $user->ban(true);
        $this->assertTrue(is_string($user->ipban()->ip_address));
        $user->unban();
        $this->assertNull($user->ipban()->ip_address);
    }
}
