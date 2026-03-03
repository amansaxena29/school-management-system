<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteSetting;
use App\Models\Course;
use App\Models\Gallery;
use App\Models\Achievement;
use App\Models\Announcement;
use Illuminate\Support\Facades\Storage;

class CmsController extends Controller
{
    // ===================== CMS DASHBOARD =====================
    public function index()
    {
        $courses       = Course::all();
        $gallery       = Gallery::all();
        $achievements  = Achievement::all();
        $announcements = Announcement::latest()->get();
        return view('admin.cms.index', compact('courses', 'gallery', 'achievements', 'announcements'));
    }

    // ===================== SITE SETTINGS =====================
    public function updateSettings(Request $request)
    {
        $request->validate([
            'hero_title'     => 'required|string|max:255',
            'hero_subtitle'  => 'required|string|max:255',
            'about_text'     => 'required|string',
            'footer_contact' => 'nullable|string',
            'footer_address' => 'nullable|string',
        ]);

        SiteSetting::set('hero_title',     $request->hero_title);
        SiteSetting::set('hero_subtitle',  $request->hero_subtitle);
        SiteSetting::set('about_text',     $request->about_text);
        SiteSetting::set('footer_contact', $request->footer_contact);
        SiteSetting::set('footer_address', $request->footer_address);

        return back()->with('success', 'Settings updated successfully!');
    }

    // ===================== COURSES =====================
    public function storeCourse(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        Course::create($request->only('title', 'description'));
        return back()->with('success', 'Course added successfully!');
    }

    public function updateCourse(Request $request, Course $course)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        $course->update($request->only('title', 'description'));
        return back()->with('success', 'Course updated successfully!');
    }

    public function deleteCourse(Course $course)
    {
        $course->delete();
        return back()->with('success', 'Course deleted!');
    }

    // ===================== GALLERY — IMAGES =====================
    public function storeGallery(Request $request)
    {
        $request->validate([
            'caption'    => 'nullable|string|max:255',
            'image_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'image_url'  => 'nullable|url',
        ]);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('gallery', 'public');
            Gallery::create([
                'image_path' => $path,
                'caption'    => $request->caption,
                'is_url'     => false,
                'type'       => 'image',
            ]);
        } elseif ($request->filled('image_url')) {
            Gallery::create([
                'image_path' => $request->image_url,
                'caption'    => $request->caption,
                'is_url'     => true,
                'type'       => 'image',
            ]);
        } else {
            return back()->withErrors(['image' => 'Please upload an image or provide a URL.']);
        }

        return back()->with('success', 'Image added to gallery!');
    }

    public function deleteGallery(Gallery $gallery)
    {
        if (!$gallery->is_url && $gallery->type === 'image') {
            if (Storage::disk('public')->exists($gallery->image_path)) {
                Storage::disk('public')->delete($gallery->image_path);
            }
        }
        if ($gallery->type === 'video' && $gallery->video_path) {
            if (Storage::disk('public')->exists($gallery->video_path)) {
                Storage::disk('public')->delete($gallery->video_path);
            }
        }
        $gallery->delete();
        return back()->with('success', 'Item deleted from gallery!');
    }

    // ===================== GALLERY — VIDEOS =====================
    public function storeVideo(Request $request)
    {
        $request->validate([
            'caption'    => 'nullable|string|max:255',
            'video_file' => 'nullable|mimes:mp4,mov,avi,webm|max:51200', // 50MB max
            'video_url'  => 'nullable|url',
        ]);

        if ($request->hasFile('video_file')) {
            $path = $request->file('video_file')->store('gallery/videos', 'public');
           Gallery::create([
                'image_path' => $path,  // store video path here too so column is never null
                'video_path' => $path,
                'caption'    => $request->caption,
                'is_url'     => false,
                'type'       => 'video',
            ]);
        } elseif ($request->filled('video_url')) {
            Gallery::create([
                'image_path' => $request->video_url,
                'video_path' => null,
                'caption'    => $request->caption,
                'is_url'     => true,
                'type'       => 'video',
            ]);
        } else {
            return back()->withErrors(['video' => 'Please upload a video file or provide a URL.']);
        }

        return back()->with('success', 'Video added to gallery!');
    }

    // ===================== ACHIEVEMENTS =====================
    public function storeAchievement(Request $request)
    {
        $request->validate(['title' => 'required|string|max:255']);
        Achievement::create($request->only('title'));
        return back()->with('success', 'Achievement added!');
    }

    public function updateAchievement(Request $request, Achievement $achievement)
    {
        $request->validate(['title' => 'required|string|max:255']);
        $achievement->update($request->only('title'));
        return back()->with('success', 'Achievement updated!');
    }

    public function deleteAchievement(Achievement $achievement)
    {
        $achievement->delete();
        return back()->with('success', 'Achievement deleted!');
    }

    // ===================== ANNOUNCEMENTS =====================
    public function storeAnnouncement(Request $request)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'body'       => 'nullable|string|max:1000',
            'type'       => 'required|in:info,warning,success,urgent',
            'expires_at' => 'nullable|date|after:today',
        ]);

        Announcement::create([
            'title'      => $request->title,
            'body'       => $request->body,
            'type'       => $request->type,
            'expires_at' => $request->expires_at ?: null,
            'is_active'  => true,
        ]);

        return back()->with('success', 'Announcement added!');
    }

    public function toggleAnnouncement(Announcement $announcement)
    {
        $announcement->update(['is_active' => !$announcement->is_active]);
        return back()->with('success', 'Announcement status updated!');
    }

    public function deleteAnnouncement(Announcement $announcement)
    {
        $announcement->delete();
        return back()->with('success', 'Announcement deleted!');
    }
}
