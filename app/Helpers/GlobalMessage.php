<?php

namespace App\Helpers;

trait GlobalMessage
{
    public function globalDispatchSweetAlert($title = '', $text = '', $icon = 'success', $action = 'dispatch'):void
    {
        $titleMessages = [
            'success' => __('lang.sweet_alert.icon.success'),
            'warning' => __('lang.sweet_alert.icon.warning'),
            'error' => __('lang.sweet_alert.icon.error'),
        ];

        $textMessages = [
            'success' => __('lang.sweet_alert.text.success'),
            'warning' => __('lang.sweet_alert.text.warning'),
            'error' => __('lang.sweet_alert.text.error'),
        ];
        if (!$title) {
            $title = $titleMessages[$icon] ?? '';
        }

        if (!$text) {
            $text = $textMessages[$icon] ?? '';
        }

        switch ($action) {
            case 'dispatch':
                $this->dispatch('global-dispatch-sweet-alert', title: $title, text: $text, icon: $icon);
                break;
            case 'session':
                session()->flash('global-session-response-alert', [
                    'title' => $title,
                    'text' => $text,
                    'icon' => $icon,
                ]);
                break;
        }
    }

    public function globalDispatchModal($modalName, $action = 'hide'):void
    {
        $this->dispatch('global-dispatch-modal', modal: $modalName, action: $action);
    }

    public function globalToastMessage($text, $destination = '#'): void
    {
        $this->dispatch('global-toast-message', text: $text, destination: $destination);
    }
}
