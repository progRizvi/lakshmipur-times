<?php

namespace App\Enums;

enum RouteList
{
    public static function getAll(): object
    {
        $route_list = [
            (object)[
                'name'       => __('Dashboard'),
                'route'      => route('admin.dashboard'),
                'permission' => 'dashboard.view',
            ],
            (object)[
                'name'       => __('Category List'),
                'route'      => route('admin.news-category.index'),
                'permission' => 'blog.category.view',
            ],
            (object)[
                'name'       => __('Post List'),
                'route'      => route('admin.news.index'),
                'permission' => 'blog.view',
            ],
            (object)[
                'name'       => __('News Comments'),
                'route'      => route('admin.news-comment.index'),
                'permission' => 'blog.comment.view',
            ],
            (object)[
                'name'       => __('Our Team'),
                'route'      => route('admin.ourteam.index'),
                'permission' => 'team.management',
            ],
            (object)[
                'name'       => __('Menu Builder'),
                'route'      => route('admin.custom-menu.index'),
                'permission' => 'menu.view',
            ],
            (object)[
                'name'       => __('Customizable Page'),
                'route'      => route('admin.custom-pages.index'),
                'permission' => 'page.view',
            ],
            (object)[
                'name'       => __('Social Links'),
                'route'      => route('admin.social-link.index'),
                'permission' => 'social.link.management',
            ],
            (object)[
                'name'       => __('Contact Messages'),
                'route'      => route('admin.contact-messages'),
                'permission' => 'contect.message.view',
            ],
            (object)[
                'name'       => __('General Settings'),
                'route'      => route('admin.general-setting'),
                'permission' => 'setting.view',
                'tab'        => 'general_tab',
            ],
            (object)[
                'name'       => __('Time & Date Setting'),
                'route'      => route('admin.general-setting'),
                'permission' => 'setting.view',
                'tab'        => 'website_tab',
            ],
            (object)[
                'name'       => __('Logo & Favicon'),
                'route'      => route('admin.general-setting'),
                'permission' => 'setting.view',
                'tab'        => 'logo_favicon_tab',
            ],
            (object)[
                'name'       => __('Default avatar'),
                'route'      => route('admin.general-setting'),
                'permission' => 'setting.view',
                'tab'        => 'default_avatar_tab',
            ],
            (object)[
                'name'       => __('Copyright Text'),
                'route'      => route('admin.general-setting'),
                'permission' => 'setting.view',
                'tab'        => 'copyright_text_tab',
            ],
            (object)[
                'name'       => __('Maintenance Mode'),
                'route'      => route('admin.general-setting'),
                'permission' => 'setting.view',
                'tab'        => 'mmaintenance_mode_tab',
            ],
            (object)[
                'name'       => __('Credential Settings'),
                'route'      => route('admin.crediential-setting'),
                'permission' => 'setting.view',
                'tab'        => 'google_recaptcha_tab',
            ],
            (object)[
                'name'       => __('Google reCaptcha'),
                'route'      => route('admin.crediential-setting'),
                'permission' => 'setting.view',
                'tab'        => 'google_recaptcha_tab'
            ],
            (object)[
                'name'       => __('Google Analytic'),
                'route'      => route('admin.crediential-setting'),
                'permission' => 'setting.view',
                'tab'        => 'google_analytic_tab',
            ],
            (object)[
                'name'       => __('Social Login'),
                'route'      => route('admin.crediential-setting'),
                'permission' => 'setting.view',
                'tab'        => 'social_login_tab',
            ],
            (object)[
                'name'       => __('Tawk Chat'),
                'route'      => route('admin.crediential-setting'),
                'permission' => 'setting.view',
                'tab'        => 'tawk_chat_tab',
            ],
            (object)[
                'name'       => __('Email Configuration'),
                'route'      => route('admin.email-configuration'),
                'permission' => 'setting.view',
                'tab'        => 'setting_tab',
            ],
            (object)[
                'name'       => __('Email Template'),
                'route'      => route('admin.email-configuration'),
                'permission' => 'setting.view',
                'tab'        => 'email_template_tab',
            ],
            (object)[
                'name'       => __('SEO Setup'),
                'route'      => route('admin.seo-setting'),
                'permission' => 'setting.view',
            ],
            (object)[
                'name'       => __('Custom CSS'),
                'route'      => route('admin.custom-code', ['type' => 'css']),
                'permission' => 'setting.view',
            ],
            (object)[
                'name'       => __('Custom JS'),
                'route'      => route('admin.custom-code', ['type' => 'js']),
                'permission' => 'setting.view',
            ],
            (object)[
                'name'       => __('Clear cache'),
                'route'      => route('admin.cache-clear'),
                'permission' => 'setting.view',
            ],
            (object)[
                'name'       => __('Database Clear'),
                'route'      => route('admin.database-clear'),
                'permission' => 'setting.view',
            ],

            (object)[
                'name'       => __('Manage Admin'),
                'route'      => route('admin.admin.index'),
                'permission' => 'admin.view',
            ],
            (object)[
                'name'       => __('Role & Permissions'),
                'route'      => route('admin.role.index'),
                'permission' => 'role.view',
            ],
        ];
        usort($route_list, function ($a, $b) {
            return strcmp($a->name, $b->name);
        });

        return (object) $route_list;
    }
}
