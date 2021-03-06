<?php

declare (strict_types = 1);

namespace HMLB\UserBundle\Tests;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use HMLB\UserBundle\Tests\Functional\TestKernel;
use HMLB\UserBundle\Tests\Model\CustomUser;
use HMLB\UserBundle\User\User;
use PHPUnit_Framework_TestCase;
use Symfony\Bundle\FrameworkBundle\Test;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * UserBundleTest.
 *
 * @author Hugues Maignol <hugues@hmlb.fr>
 */
class UserBundleTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setUp()
    {
        $kernel = new TestKernel('test', true);
        $kernel->boot();

        $this->container = $kernel->getContainer();
    }

    /**
     * @test
     */
    public function mappingsAreLoaded()
    {
        $doctrine = $this->container->get('doctrine');
        /** @var EntityManager $em */
        $em = $doctrine->getManager();
        $this->assertInstanceOf(EntityManager::class, $em);
        $this->assertInstanceOf(EntityRepository::class, $em->getRepository(User::class));
    }

    /**
     * @test
     *
     * @dataProvider expectedInitialParameters
     */
    public function parametersAreInitialized($parameterName, $expectedValue)
    {
        $this->assertEquals($expectedValue, $this->container->getParameter($parameterName));
    }

    /**
     * Provider for parametersAreInitialized().
     *
     * @return array
     */
    public static function expectedInitialParameters()
    {
        return [
            ['hmlb_user.user_class', CustomUser::class],
        ];
    }
}
