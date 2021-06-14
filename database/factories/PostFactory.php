<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $photos=[];
        for($i=1; $i<=8; $i++){
            $photos[$i] ='image('.$i.').jpg';
        }
        $users = [];
        for($i=1; $i<=3; $i++){
            $users[$i] = $i;
        }

        return [
            'title' => $this->faker->sentence(6),
            'status' => 1,
            'image' => Arr::random($photos),
            'user_id' => Arr::random($users)
        ];
    }
}
