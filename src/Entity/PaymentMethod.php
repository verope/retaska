<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PaymentMethodRepository")
 */
class PaymentMethod
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="float")
     */
    private $surcharge;

    /**
     * @ORM\Column(type="float")
     */
    private $priceEur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PurchaseOrder", mappedBy="paymentMethod")
     */
    private $purchaseOrders;

    public function __construct()
    {
        $this->purchaseOrders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getSurcharge(): ?float
    {
        return $this->surcharge;
    }

    public function setSurcharge(float $surcharge): self
    {
        $this->surcharge = $surcharge;

        return $this;
    }

    public function getPriceEur(): ?float
    {
        return $this->priceEur;
    }

    public function setPriceEur(float $priceEur): self
    {
        $this->priceEur = $priceEur;

        return $this;
    }

    /**
     * @return Collection|PurchaseOrder[]
     */
    public function getPurchaseOrders(): Collection
    {
        return $this->purchaseOrders;
    }

    public function addPurchaseOrder(PurchaseOrder $purchaseOrder): self
    {
        if (!$this->purchaseOrders->contains($purchaseOrder)) {
            $this->purchaseOrders[] = $purchaseOrder;
            $purchaseOrder->setPaymentMethod($this);
        }

        return $this;
    }

    public function removePurchaseOrder(PurchaseOrder $purchaseOrder): self
    {
        if ($this->purchaseOrders->contains($purchaseOrder)) {
            $this->purchaseOrders->removeElement($purchaseOrder);
            // set the owning side to null (unless already changed)
            if ($purchaseOrder->getPaymentMethod() === $this) {
                $purchaseOrder->setPaymentMethod(null);
            }
        }

        return $this;
    }
}
