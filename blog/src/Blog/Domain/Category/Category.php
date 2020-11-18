<?php

declare(strict_types=1);

namespace App\Blog\Domain\Category;

use App\Blog\Domain\Shared\CategoryId;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="category")
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 * @ORM\Entity()
 */
final class Category
{
    /**
     * @ORM\Embedded(class="App\Blog\Domain\Shared\CategoryId", columnPrefix=false)
     */
    private CategoryId $categoryId;

    /**
     * @ORM\Embedded(class="App\Blog\Domain\Category\Name", columnPrefix=false)
     */
    private Name $name;

    /**
     * @ORM\Embedded(class="Timeline", columnPrefix=false)
     */
    private Timeline $timeline;

    public function __construct(CategoryId $categoryId, Name $name)
    {
        $this->categoryId = $categoryId;
        $this->name = $name;
        $this->timeline = new Timeline();
    }
}
