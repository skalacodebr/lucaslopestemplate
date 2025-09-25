import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/css/admin.css',
<<<<<<< Updated upstream
<<<<<<< Updated upstream
        'resources/css/live-queue.css',
        'resources/css/scheduled-consultation.css',
        'resources/css/video-call.css',
=======
        'resources/css/pages/telemedicine.css',
        'resources/js/pages/telemedicine.js',
        'resources/css/components/consultation-card.css',
>>>>>>> Stashed changes
=======
        'resources/css/pages/telemedicine.css',
        'resources/js/pages/telemedicine.js',
        'resources/css/components/consultation-card.css',
>>>>>>> Stashed changes
      ],
      refresh: true,
    }),
  ],
})
