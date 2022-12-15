<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserNotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $notificationTypes = [NOTIFICATION_TYPE_NORMAL, NOTIFICATION_TYPE_SUCCESS];

        $user = User::where('role', ACCOUNT_ROLE_USER)->first();

        if(!$user) {
            return;
        }

        return [
            'user_id' => $user->id,
            'title' => $this->faker->text(rand(5, 100)),
            'content' => $this->faker->text(500),
            'type' => $notificationTypes[array_rand($notificationTypes, 1)],
            'is_read' => rand(NOTIFICATION_IS_READ_OFF, NOTIFICATION_IS_READ_ON),
            'created_by' => CREATED_BY_SYSTEM,
            'created_at' => Carbon::now()->subHours(3),
            'updated_by' => CREATED_BY_SYSTEM,
            'updated_at' => Carbon::now()->subHours(3),
        ];
    }
}
