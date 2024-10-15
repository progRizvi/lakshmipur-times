<?php

namespace Modules\PageBuilder\database\seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\PageBuilder\app\Models\CustomizeablePage;

class CustomizeablePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::unguard();
        $page = new CustomizeablePage();
        $page->title = 'Terms & Conditions';
        $page->slug = 'terms-contidions';
        $page->description = '<h3>Your agreement:</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad, repellendus! Nesciunt fugit
                            aliquam
                            doloremque velit ullam quos ad et magnam aperiam eum vero unde cum reprehenderit porro
                            consectetur voluptatum, veritatis blanditiis. Repellendus veritatis fugit maxime nostrum
                            quod
                            ipsum, quibusdam, a omnis quam aperiam pariatur consectetur est perspiciatis. Laboriosam
                            praesentium id asperiores cumque debitis, ex adipisci? Impedit temporibus labore dolores
                            iusto
                            error nobis, porro hic iure placeat, sint esse corporis, quibusdam adipisci magni non minus
                            quo
                            quae repudiandae earum facere eum ad qui voluptatum eaque.</p>
                        <h3>Main responsibilities:</h3>
                        <ul>
                            <li>Solve the problem with code.</li>
                            <li>Work on Client\'s projects & In-house products as well.</li>
                            <li>Analyze the product\'s needs and find out the best solutions.</li>
                            <li>Work as a team and lead the junior developer.</li>
                            <li>Collaborate with other teams by providing code review and technical direction.</li>
                        </ul>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad, repellendus! Nesciunt fugit
                            aliquam doloremque velit ullam quos ad et magnam aperiam eum vero unde cum reprehenderit
                            porro consectetur voluptatum, veritatis blanditiis. Repellendus veritatis fugit maxime
                            nostrum quod ipsum, quibusdam, a omnis quam aperiam pariatur</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad, repellendus! Nesciunt fugit
                            aliquam
                            doloremque velit ullam quos ad et magnam aperiam eum vero unde cum reprehenderit porro
                            consectetur voluptatum, veritatis blanditiis. Repellendus veritatis fugit maxime nostrum
                            quod
                            ipsum, quibusdam, a omnis quam aperiam pariatur consectetur est perspiciatis. Laboriosam
                            praesentium id asperiores cumque debitis, ex adipisci? Impedit temporibus labore dolores
                            iusto
                            error nobis, porro hic iure placeat, sint esse corporis, quibusdam adipisci magni non minus
                            quo
                            quae repudiandae earum facere eum ad qui voluptatum eaque.</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad, repellendus! Nesciunt fugit
                            aliquam doloremque velit ullam quos ad et magnam aperiam eum vero unde cum reprehenderit
                            porro consectetur voluptatum, veritatis blanditiis. Repellendus veritatis fugit maxime
                            nostrum quod ipsum, quibusdam, a omnis quam aperiam pariatur</p>
                        <ul>
                            <li>Solve the problem with code.</li>
                            <li>Work on Client\'s projects & In-house products as well.</li>
                            <li>Analyze the product\'s needs and find out the best solutions.</li>
                            <li>Work as a team and lead the junior developer.</li>
                            <li>Collaborate with other teams by providing code review and technical direction.</li>
                        </ul>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad, repellendus! Nesciunt fugit
                            aliquam
                            doloremque velit ullam quos ad et magnam aperiam eum vero unde cum reprehenderit porro
                            consectetur voluptatum, veritatis blanditiis. Repellendus veritatis fugit maxime nostrum
                            quod
                            ipsum, quibusdam, a omnis quam aperiam pariatur consectetur est perspiciatis. Laboriosam
                            praesentium id asperiores cumque debitis, ex adipisci? Impedit temporibus labore dolores
                            iusto
                            error nobis, porro hic iure placeat, sint esse corporis, quibusdam adipisci magni non minus
                            quo
                            quae repudiandae earum facere eum ad qui voluptatum eaque.</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad, repellendus! Nesciunt fugit
                            aliquam doloremque velit ullam quos ad et magnam aperiam eum vero unde cum reprehenderit
                            porro consectetur voluptatum, veritatis blanditiis. Repellendus veritatis fugit maxime
                            nostrum quod ipsum, quibusdam, a omnis quam aperiam pariatur</p>
                        <a href="/" class="common_btn">go home</a>';
        $page->save();

        $page = new CustomizeablePage();
        $page->title = 'Privacy Policy';
        $page->slug = 'privacy-policy';
        $page->description = '<h3>Your agreement:</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad, repellendus! Nesciunt fugit
                            aliquam
                            doloremque velit ullam quos ad et magnam aperiam eum vero unde cum reprehenderit porro
                            consectetur voluptatum, veritatis blanditiis. Repellendus veritatis fugit maxime nostrum
                            quod
                            ipsum, quibusdam, a omnis quam aperiam pariatur consectetur est perspiciatis. Laboriosam
                            praesentium id asperiores cumque debitis, ex adipisci? Impedit temporibus labore dolores
                            iusto
                            error nobis, porro hic iure placeat, sint esse corporis, quibusdam adipisci magni non minus
                            quo
                            quae repudiandae earum facere eum ad qui voluptatum eaque.</p>
                        <h3>Main responsibilities:</h3>
                        <ul>
                            <li>Solve the problem with code.</li>
                            <li>Work on Client\'s projects & In-house products as well.</li>
                            <li>Analyze the product\'s needs and find out the best solutions.</li>
                            <li>Work as a team and lead the junior developer.</li>
                            <li>Collaborate with other teams by providing code review and technical direction.</li>
                        </ul>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad, repellendus! Nesciunt fugit
                            aliquam doloremque velit ullam quos ad et magnam aperiam eum vero unde cum reprehenderit
                            porro consectetur voluptatum, veritatis blanditiis. Repellendus veritatis fugit maxime
                            nostrum quod ipsum, quibusdam, a omnis quam aperiam pariatur</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad, repellendus! Nesciunt fugit
                            aliquam
                            doloremque velit ullam quos ad et magnam aperiam eum vero unde cum reprehenderit porro
                            consectetur voluptatum, veritatis blanditiis. Repellendus veritatis fugit maxime nostrum
                            quod
                            ipsum, quibusdam, a omnis quam aperiam pariatur consectetur est perspiciatis. Laboriosam
                            praesentium id asperiores cumque debitis, ex adipisci? Impedit temporibus labore dolores
                            iusto
                            error nobis, porro hic iure placeat, sint esse corporis, quibusdam adipisci magni non minus
                            quo
                            quae repudiandae earum facere eum ad qui voluptatum eaque.</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad, repellendus! Nesciunt fugit
                            aliquam doloremque velit ullam quos ad et magnam aperiam eum vero unde cum reprehenderit
                            porro consectetur voluptatum, veritatis blanditiis. Repellendus veritatis fugit maxime
                            nostrum quod ipsum, quibusdam, a omnis quam aperiam pariatur</p>
                        <ul>
                            <li>Solve the problem with code.</li>
                            <li>Work on Client\'s projects & In-house products as well.</li>
                            <li>Analyze the product\'s needs and find out the best solutions.</li>
                            <li>Work as a team and lead the junior developer.</li>
                            <li>Collaborate with other teams by providing code review and technical direction.</li>
                        </ul>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad, repellendus! Nesciunt fugit
                            aliquam
                            doloremque velit ullam quos ad et magnam aperiam eum vero unde cum reprehenderit porro
                            consectetur voluptatum, veritatis blanditiis. Repellendus veritatis fugit maxime nostrum
                            quod
                            ipsum, quibusdam, a omnis quam aperiam pariatur consectetur est perspiciatis. Laboriosam
                            praesentium id asperiores cumque debitis, ex adipisci? Impedit temporibus labore dolores
                            iusto
                            error nobis, porro hic iure placeat, sint esse corporis, quibusdam adipisci magni non minus
                            quo
                            quae repudiandae earum facere eum ad qui voluptatum eaque.</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad, repellendus! Nesciunt fugit
                            aliquam doloremque velit ullam quos ad et magnam aperiam eum vero unde cum reprehenderit
                            porro consectetur voluptatum, veritatis blanditiis. Repellendus veritatis fugit maxime
                            nostrum quod ipsum, quibusdam, a omnis quam aperiam pariatur</p>
                        <a href="/" class=\'common_btn\'>go home</a>';
        $page->save();
    }
}
