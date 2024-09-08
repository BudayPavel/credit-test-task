<?php

declare(strict_types=1);

namespace App\Model\Loan\Entity\Loan;

use App\Model\Loan\Entity\VO\Rate;
use App\Model\Loan\Entity\VO\Term;
use App\Model\Loan\Entity\VO\Id;
use App\Model\Loan\Entity\VO\Name;
use App\Model\Loan\Entity\VO\Amount;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: self::TABLE)]
class Loan
{
    public const TABLE = 'loans';
    public const CLIENT_TABLE = 'clients';

    #[ORM\Column(type: Id::NAME)]
    #[ORM\Id]
    private readonly Id $id;

    #[ORM\Column(type: Id::NAME)]
    private readonly Id $clientId;

    #[ORM\Column(type: Name::NAME)]
    private readonly Name $name;

    #[ORM\Column(type: Term::NAME)]
    private readonly Term $term;
    #[ORM\Column(type: Rate::NAME, precision: 2, scale: 2, nullable: true)]
    private readonly Rate $interestRate;

    #[ORM\Column(type: Amount::NAME, precision: 10, scale: 2, nullable: true)]
    private readonly Amount $amount;

    public function __construct(Id $id, Id $clientId, Name $name, Term $term, Rate $interestRate, Amount $amount)
    {
        $this->id = $id;
        $this->clientId = $clientId;
        $this->name = $name;
        $this->term = $term;
        $this->interestRate = $interestRate;
        $this->amount = $amount;
    }

    public static function create(
        Id $id,
        Id $clientId,
        Name $name,
        Term $term,
        Rate $interestRate,
        Amount $amount,
    ): self {
        return new self(
            id: $id,
            clientId: $clientId,
            name: $name,
            term: $term,
            interestRate: $interestRate,
            amount: $amount,
        );
    }
}
