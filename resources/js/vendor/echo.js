import { router } from '@inertiajs/react';
import { configureEcho, echo } from '@laravel/echo-react';

router.on('before', (event) => {
    const id = echo().socketId();
    if (!id) return;
    event.detail.visit.headers['X-Socket-ID'] = id;
});

configureEcho({
    broadcaster: 'reverb',
})
