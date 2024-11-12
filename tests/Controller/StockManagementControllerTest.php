<?php

namespace App\Test\Controller;

use App\Entity\StockManagement;
use App\Repository\StockManagementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StockManagementControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private StockManagementRepository $repository;
    private string $path = '/stock/management/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(StockManagement::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('StockManagement index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'stock_management[name]' => 'Testing',
            'stock_management[ProductDescription]' => 'Testing',
            'stock_management[AvailableQuantity]' => 'Testing',
            'stock_management[PricePerItem]' => 'Testing',
            'stock_management[ProductCategory]' => 'Testing',
            'stock_management[Supplier]' => 'Testing',
            'stock_management[sku]' => 'Testing',
            'stock_management[location]' => 'Testing',
            'stock_management[CreationDate]' => 'Testing',
            'stock_management[MinimumStock]' => 'Testing',
            'stock_management[LastPurchased]' => 'Testing',
            'stock_management[TotalValue]' => 'Testing',
        ]);

        self::assertResponseRedirects('/stock/management/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new StockManagement();
        $fixture->setName('My Title');
        $fixture->setProductDescription('My Title');
        $fixture->setAvailableQuantity('My Title');
        $fixture->setPricePerItem('My Title');
        $fixture->setProductCategory('My Title');
        $fixture->setSupplier('My Title');
        $fixture->setSku('My Title');
        $fixture->setLocation('My Title');
        $fixture->setCreationDate('My Title');
        $fixture->setMinimumStock('My Title');
        $fixture->setLastPurchased('My Title');
        $fixture->setTotalValue('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('StockManagement');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new StockManagement();
        $fixture->setName('My Title');
        $fixture->setProductDescription('My Title');
        $fixture->setAvailableQuantity('My Title');
        $fixture->setPricePerItem('My Title');
        $fixture->setProductCategory('My Title');
        $fixture->setSupplier('My Title');
        $fixture->setSku('My Title');
        $fixture->setLocation('My Title');
        $fixture->setCreationDate('My Title');
        $fixture->setMinimumStock('My Title');
        $fixture->setLastPurchased('My Title');
        $fixture->setTotalValue('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'stock_management[name]' => 'Something New',
            'stock_management[ProductDescription]' => 'Something New',
            'stock_management[AvailableQuantity]' => 'Something New',
            'stock_management[PricePerItem]' => 'Something New',
            'stock_management[ProductCategory]' => 'Something New',
            'stock_management[Supplier]' => 'Something New',
            'stock_management[sku]' => 'Something New',
            'stock_management[location]' => 'Something New',
            'stock_management[CreationDate]' => 'Something New',
            'stock_management[MinimumStock]' => 'Something New',
            'stock_management[LastPurchased]' => 'Something New',
            'stock_management[TotalValue]' => 'Something New',
        ]);

        self::assertResponseRedirects('/stock/management/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getProductDescription());
        self::assertSame('Something New', $fixture[0]->getAvailableQuantity());
        self::assertSame('Something New', $fixture[0]->getPricePerItem());
        self::assertSame('Something New', $fixture[0]->getProductCategory());
        self::assertSame('Something New', $fixture[0]->getSupplier());
        self::assertSame('Something New', $fixture[0]->getSku());
        self::assertSame('Something New', $fixture[0]->getLocation());
        self::assertSame('Something New', $fixture[0]->getCreationDate());
        self::assertSame('Something New', $fixture[0]->getMinimumStock());
        self::assertSame('Something New', $fixture[0]->getLastPurchased());
        self::assertSame('Something New', $fixture[0]->getTotalValue());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new StockManagement();
        $fixture->setName('My Title');
        $fixture->setProductDescription('My Title');
        $fixture->setAvailableQuantity('My Title');
        $fixture->setPricePerItem('My Title');
        $fixture->setProductCategory('My Title');
        $fixture->setSupplier('My Title');
        $fixture->setSku('My Title');
        $fixture->setLocation('My Title');
        $fixture->setCreationDate('My Title');
        $fixture->setMinimumStock('My Title');
        $fixture->setLastPurchased('My Title');
        $fixture->setTotalValue('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/stock/management/');
    }
}
