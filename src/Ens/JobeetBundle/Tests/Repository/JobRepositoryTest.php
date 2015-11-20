<?php

namespace Ens\JobeetBundle\Tests\Repository;
use Ens\JobeetBundle\Entity\Job;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class JobRepositoryTest extends WebTestCase
{
    public function testGetForLuceneQuery()
    {
        $kernel = static::createKernel();
        $kernel->boot();
        $em = $kernel->getContainer()->get('doctrine.orm.entity_manager');

        $job = new Job();
        $job->setType('part-time');
        $job->setCompany('Sensio');
        $job->setPosition('FOO6');
        $job->setLocation('Paris');
        $job->setDescription('WebDevelopment');
        $job->setHowToApply('Send resumee');
        $job->setEmail('jobeet@example.com');
        $job->setUrl('http://sensio-labs.com');
        $job->setIsActivated(false);

        $em->persist($job);
        $em->flush();

        $jobs = $em->getRepository('EnsJobeetBundle:Job')->getForLuceneQuery('FOO6');
        $this->assertEquals(count($jobs), 0);

        $job = new Job();
        $job->setType('part-time');
        $job->setCompany('Sensio');
        $job->setPosition('FOO7');
        $job->setLocation('Paris');
        $job->setDescription('WebDevelopment');
        $job->setHowToApply('Send resumee');
        $job->setEmail('jobeet@example.com');
        $job->setUrl('http://sensio-labs.com');
        $job->setIsActivated(true);

        $em->persist($job);
        $em->flush();

        $jobs = $em->getRepository('EnsJobeetBundle:Job')->getForLuceneQuery('position:FOO7');
        $this->assertEquals(count($jobs), 1);
        foreach ($jobs as $job_rep) {
            $this->assertEquals($job_rep->getId(), $job->getId());
        }

        $em->remove($job);
        $em->flush();

        $jobs = $em->getRepository('EnsJobeetBundle:Job')->getForLuceneQuery('position:FOO7');

        $this->assertEquals(count($jobs), 0);
    }
}
