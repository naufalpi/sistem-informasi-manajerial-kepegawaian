<?php

namespace App\Models;



class Post 
{
    private static $blog_posts = [
        [
            "title" => "Membuat Website",
            "slug" => "membuat-website",
            "author" => "a.k.a boyinsad",
            "body" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Magni, officia. Quasi nemo itaque, omnis quia doloribus dignissimos voluptatibus. Deserunt vero expedita nobis, laboriosam ut obcaecati debitis quidem aperiam blanditiis dolorem illo? Laboriosam facere quod eligendi commodi possimus, veniam sapiente inventore recusandae fugit soluta ut corporis id labore? Maiores molestiae neque consectetur cumque exercitationem quisquam ad ipsa recusandae? Iusto tempore cum maiores rem fugiat similique veritatis saepe distinctio est temporibus dolorem deleniti totam numquam blanditiis odit aliquam quasi, neque, minima ex."
        ],

        [
            "title" => "Membuat Game",
            "slug" => "membuat-game",
            "author" => "Tono Mulyono",
            "body" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Magni, officia. Quasi nemo itaque, omnis quia doloribus dignissimos voluptatibus. Deserunt vero expedita nobis, laboriosam ut obcaecati debitis quidem aperiam blanditiis dolorem illo? Laboriosam facere quod eligendi commodi possimus, veniam sapiente inventore recusandae fugit soluta ut corporis id labore? Maiores molestiae neque consectetur cumque exercitationem quisquam ad ipsa recusandae? Iusto tempore cum maiores rem fugiat similique veritatis saepe distinctio est temporibus dolorem deleniti totam numquam blanditiis odit aliquam quasi, neque, minima ex."
        ],

        [
            "title" => "Membuat Aplikasi Android",
            "slug" => "membuat-aplikasi-android",
            "author" => "Aulia Khaerunisa",
            "body" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Magni, officia. Quasi nemo itaque, omnis quia doloribus dignissimos voluptatibus. Deserunt vero expedita nobis, laboriosam ut obcaecati debitis quidem aperiam blanditiis dolorem illo? Laboriosam facere quod eligendi commodi possimus, veniam sapiente inventore recusandae fugit soluta ut corporis id labore? Maiores molestiae neque consectetur cumque exercitationem quisquam ad ipsa recusandae? Iusto tempore cum maiores rem fugiat similique veritatis saepe distinctio est temporibus dolorem deleniti totam numquam blanditiis odit aliquam quasi, neque, minima ex."
        ]
    ];

    public static function all()
    {
        return collect(self::$blog_posts);
    }

    public static function find($slug)
    { 
        $posts = static::all();
        return $posts->firstWhere('slug', $slug);
    }
}
