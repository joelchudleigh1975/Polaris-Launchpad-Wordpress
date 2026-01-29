# Polaris Launchpad WordPress Site - Responsive Implementation Plan

**Project**: Making polaris-launchpad.com fully responsive across all devices  
**Staging Site**: http://staging.polaris-launchpad.com  
**Date Created**: January 27, 2026  
**Status**: Ready to implement

---

## 🎯 OBJECTIVE

Transform the current fixed-width (1440px) WordPress site into a fully responsive website that works seamlessly on:
- **Desktop**: 1440px+ (existing design)
- **Tablet**: 768px - 1439px
- **Mobile**: 320px - 767px

---

## 🔍 CURRENT ISSUES IDENTIFIED

### Critical Problems:
1. **Fixed 1440px width** throughout entire site - breaks on smaller screens
2. **No mobile navigation** - desktop menu unusable on mobile
3. **Fixed positioning** - Absolute positioning breaks responsive flow
4. **Non-responsive images** - Images don't scale down
5. **Typography doesn't scale** - Text too small on mobile despite having mobile CSS variables ready
6. **Buttons don't adapt** - CTA buttons too small for mobile interaction

### Assets Available:
✅ **Responsive CSS variables already exist** in styleguide.css  
✅ **Mobile typography variables** are defined but not implemented  
✅ **Clean theme structure** with custom blocks  
✅ **Staging environment** ready for testing  

---

## 📋 IMPLEMENTATION PHASES

## Phase 1: Foundation & Container Fixes (Priority: CRITICAL)
**Estimated Time**: 2-3 hours  
**Testing**: After each change

### 1.1 Fix Base Container Width
**File**: `/wp-content/themes/polaris-homepage/style.css`

```css
/* CURRENT PROBLEM */
.homepage {
  width: 1440px; /* BREAKS ON SMALLER SCREENS */
}

/* SOLUTION */
.homepage {
  max-width: 1440px;
  width: 100%;
  margin: 0 auto;
  padding: 0 20px; /* Add breathing room */
}

/* Responsive padding */
@media (max-width: 768px) {
  .homepage {
    padding: 0 16px;
  }
}
```

### 1.2 Fix ALL Fixed Widths
**Search and Replace**: All instances of `width: 1440px` → `max-width: 1440px; width: 100%;`

### 1.3 Hero Section Background Fix
```css
.homepage .overlap {
  width: 100%; /* Remove fixed 2910px width */
  max-width: 1440px;
  height: 100vh;
  min-height: 600px;
  background-size: cover; /* Remove fixed pixel sizes */
}
```

**Test Checkpoint**: Site should no longer horizontally scroll on smaller screens

---

## DETAILED BLOCK ANALYSIS & IMPLEMENTATION

## 🎯 COMPREHENSIVE HEADER BLOCKS IMPLEMENTATION PLAN

### CURRENT STATE ANALYSIS:

#### **Dark Header (homepage)** - `header-block.php` 
- **BROKEN**: Lines 191-312 contain conflicting inline CSS
- **BROKEN**: Lines 5353-5686 in style.css contain broken mobile CSS  
- **DESKTOP CSS**: Lines 235-243 use absolute positioning (`position: absolute; top: 30px; left: 804px`)
- **JAVASCRIPT**: Working burger menu functionality exists
- **HTML STRUCTURE**: Proper burger menu elements exist

#### **White Header (inner pages)** - `header-block-white.php`
- **CLEAN STATE**: No broken CSS
- **MISSING**: No mobile functionality - no burger menu HTML or JavaScript
- **DESKTOP CSS**: Lines 1857-1975 use relative positioning but fixed widths

### DETAILED IMPLEMENTATION PLAN:

## **PHASE 1: EMERGENCY CLEANUP (Dark Header)**

### **Step 1: Remove Broken Inline CSS**
**File**: `/wp-content/themes/polaris-homepage/blocks/header-block.php`
**Lines to DELETE**: 191-312
**ACTION**: Remove entire `<style>@media (max-width: 768px)...entire section...</style>` block

### **Step 2: Remove Broken Mobile CSS Section** 
**File**: `/wp-content/themes/polaris-homepage/style.css`
**Lines to DELETE**: 5353-5686
**FIND**: `/* Mobile Header and Navigation */`
**DELETE**: Everything from line 5353 to line 5686

## **PHASE 2: DESKTOP CSS FOUNDATION FIXES**

### **Dark Header Desktop Fix**
**File**: `/wp-content/themes/polaris-homepage/style.css`
**Lines 235-243**: Replace absolute positioning

**CURRENT BROKEN CSS:**
```css
.homepage .header {
  display: inline-flex;
  align-items: center;
  gap: 94px;
  position: absolute;    /* ← BREAKS RESPONSIVE */
  top: 30px;            /* ← FIXED POSITION */
  left: 804px;          /* ← FIXED POSITION */
  background-color: transparent;
}
```

**REPLACE WITH:**
```css
.homepage .header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 20px;
  position: relative;      /* ← RESPONSIVE FRIENDLY */
  padding: 30px 60px;     /* ← FLEXIBLE PADDING */
  max-width: 1440px;      /* ← CONSTRAIN WIDTH */
  margin: 0 auto;         /* ← CENTER CONTENT */
  background-color: transparent;
  width: 100%;
  box-sizing: border-box;
}
```

### **White Header Desktop Fix**
**File**: `/wp-content/themes/polaris-homepage/style.css`
**Lines 1857-1875**: Fix fixed width and positioning

**CURRENT CSS:**
```css
.header-innerpage {
  position: relative;
  width: 1440px;          /* ← FIXED WIDTH */
  height: 138px;
  background-color: #ffffff;
}

.header-innerpage .header {
  display: inline-flex;
  align-items: center;
  gap: 94px;
  position: relative;
  top: 24px;              /* ← FIXED POSITION */
  left: 69px;             /* ← FIXED POSITION */
  background-color: transparent;
}
```

**REPLACE WITH:**
```css
.header-innerpage {
  position: relative;
  width: 100%;            /* ← RESPONSIVE WIDTH */
  min-height: 138px;
  background-color: #ffffff;
  padding: 0 20px;        /* ← RESPONSIVE PADDING */
  box-sizing: border-box;
}

.header-innerpage .header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 20px;
  position: relative;
  padding: 24px 60px;     /* ← FLEXIBLE PADDING */
  background-color: transparent;
  width: 100%;
  box-sizing: border-box;
  max-width: 1440px;
  margin: 0 auto;
}
```

## **PHASE 3: MOBILE CSS IMPLEMENTATION**

### **Dark Header Mobile CSS**
**File**: `/wp-content/themes/polaris-homepage/style.css`
**INSERT after line 5351** (after existing hero mobile CSS)

```css
/* DARK HEADER MOBILE - Homepage */
@media (max-width: 768px) {
  .homepage .header {
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    padding: 20px;
    position: relative;
    height: auto;
    min-height: 80px;
  }
  
  /* Logo - responsive sizing */
  .homepage .polaris-logo {
    width: 180px;
    height: auto;
    order: 1;
  }
  
  /* Hide desktop navigation completely */
  .homepage .group-2 {
    display: none;
  }
  
  /* Show and style mobile burger menu */
  .homepage .mobile-menu-toggle {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    width: 30px;
    height: 22px;
    background: none;
    border: none;
    cursor: pointer;
    order: 3;
    position: relative;
    z-index: 10000;
  }
  
  .homepage .burger-line {
    width: 100%;
    height: 3px;
    background-color: white;        /* White lines for dark background */
    border-radius: 2px;
    transition: all 0.3s ease;
  }
  
  /* Mobile dropdown overlay */
  .homepage .group-2.mobile-menu-open {
    display: block;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(44, 62, 80, 0.98);   /* Dark overlay */
    z-index: 9999;
    padding: 100px 20px 20px;
    overflow-y: auto;
  }
  
  /* Mobile navigation structure */
  .homepage .group-2.mobile-menu-open .frame-2 {
    display: flex;
    flex-direction: column;
    gap: 0;
    width: 100%;
    margin-bottom: 40px;
  }
  
  .homepage .group-2.mobile-menu-open .div-wrapper {
    width: 100%;
    padding: 15px 0;
    border-bottom: 1px solid rgba(255,255,255,0.1);
  }
  
  .homepage .group-2.mobile-menu-open .text-wrapper-2 a {
    color: white;                   /* White text for dark background */
    font-size: 18px;
    font-weight: 600;
    display: block;
    width: 100%;
    text-decoration: none;
    text-align: center;
  }
  
  /* Mobile CTA buttons */
  .homepage .group-2.mobile-menu-open .small-button,
  .homepage .group-2.mobile-menu-open .button-wrapper {
    width: 100%;
    margin: 20px 0;
  }
  
  .homepage .group-2.mobile-menu-open .button-2 {
    width: 100%;
    padding: 15px 20px;
    text-align: center;
    font-size: 16px;
    font-weight: 600;
    border-radius: 8px;
    display: block;
    text-decoration: none;
    transition: all 0.3s ease;
  }
  
  /* Button styling - Login */
  .homepage .group-2.mobile-menu-open .small-button .button-2 {
    background: transparent;
    color: white;
    border: 2px solid white;
  }
  
  /* Button styling - Start Trial */
  .homepage .group-2.mobile-menu-open .button-wrapper .button-2 {
    background: var(--flare-orange);
    color: white;
    border: none;
  }
  
  /* Burger menu animation */
  .homepage .mobile-menu-toggle.active .burger-line:nth-child(1) {
    transform: rotate(45deg) translate(6px, 6px);
  }
  
  .homepage .mobile-menu-toggle.active .burger-line:nth-child(2) {
    opacity: 0;
  }
  
  .homepage .mobile-menu-toggle.active .burger-line:nth-child(3) {
    transform: rotate(-45deg) translate(6px, -6px);
  }
}
```

### **White Header Mobile CSS**
**File**: `/wp-content/themes/polaris-homepage/style.css`
**INSERT after dark header mobile CSS**

```css
/* WHITE HEADER MOBILE - Inner Pages */
@media (max-width: 768px) {
  .header-innerpage {
    min-height: auto;
    padding: 0;
  }
  
  .header-innerpage .header {
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    padding: 20px;
    gap: 15px;
  }
  
  /* Logo responsive sizing */
  .header-innerpage .polaris-logo {
    width: 180px;
    height: auto;
  }
  
  /* Hide desktop navigation */
  .header-innerpage .group {
    display: none;
  }
  
  /* Show mobile burger menu */
  .header-innerpage .mobile-menu-toggle {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    width: 30px;
    height: 22px;
    background: none;
    border: none;
    cursor: pointer;
    z-index: 10000;
  }
  
  .header-innerpage .burger-line {
    width: 100%;
    height: 3px;
    background-color: var(--dark-grey);     /* Dark lines for light background */
    border-radius: 2px;
    transition: all 0.3s ease;
  }
  
  /* Mobile dropdown menu */
  .header-innerpage .group.mobile-menu-open {
    display: block;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.98);  /* Light overlay */
    z-index: 9999;
    padding: 100px 20px 20px;
    overflow-y: auto;
  }
  
  .header-innerpage .group.mobile-menu-open .frame {
    flex-direction: column;
    gap: 0;
    width: 100%;
    position: relative;
  }
  
  .header-innerpage .group.mobile-menu-open .div-wrapper {
    width: 100%;
    padding: 15px 0;
    border-bottom: 1px solid rgba(0,0,0,0.1);
  }
  
  .header-innerpage .group.mobile-menu-open .text-wrapper a {
    color: var(--dark-grey);        /* Dark text for light background */
    font-size: 18px;
    font-weight: 600;
    display: block;
    width: 100%;
    text-decoration: none;
    text-align: center;
  }
  
  /* Mobile buttons */
  .header-innerpage .group.mobile-menu-open .small-button,
  .header-innerpage .group.mobile-menu-open .button-wrapper {
    width: 100%;
    margin: 20px 0;
  }
  
  .header-innerpage .group.mobile-menu-open .button {
    width: 100%;
    padding: 15px 20px;
    text-align: center;
    font-size: 16px;
    font-weight: 600;
    border-radius: 8px;
    display: block;
    text-decoration: none;
  }
  
  /* Burger menu animation */
  .header-innerpage .mobile-menu-toggle.active .burger-line:nth-child(1) {
    transform: rotate(45deg) translate(6px, 6px);
  }
  
  .header-innerpage .mobile-menu-toggle.active .burger-line:nth-child(2) {
    opacity: 0;
  }
  
  .header-innerpage .mobile-menu-toggle.active .burger-line:nth-child(3) {
    transform: rotate(-45deg) translate(6px, -6px);
  }
}
```

## **PHASE 4: HTML STRUCTURE FIXES**

### **White Header HTML Addition**
**File**: `/wp-content/themes/polaris-homepage/blocks/header-block-white.php`
**Add burger menu HTML after line 58**:

```php
<!-- Mobile burger menu button -->
<button class="mobile-menu-toggle" id="mobile-menu-toggle-white" aria-label="Toggle navigation menu">
    <span class="burger-line"></span>
    <span class="burger-line"></span>
    <span class="burger-line"></span>
</button>
```

**Update navigation div with ID (line 60)**:
```php
<div class="group" id="main-navigation-white">
```

## **PHASE 5: JAVASCRIPT IMPLEMENTATION**

### **White Header JavaScript**
**File**: `/wp-content/themes/polaris-homepage/blocks/header-block-white.php`
**Add before closing `?>` tag**:

```javascript
<script>
// Mobile menu toggle functionality for white header
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle-white');
    const mainNavigation = document.getElementById('main-navigation-white');
    
    if (mobileMenuToggle && mainNavigation) {
        mobileMenuToggle.addEventListener('click', function() {
            mobileMenuToggle.classList.toggle('active');
            mainNavigation.classList.toggle('mobile-menu-open');
            
            // Toggle aria-expanded for accessibility
            const isOpen = mainNavigation.classList.contains('mobile-menu-open');
            mobileMenuToggle.setAttribute('aria-expanded', isOpen);
            
            // Prevent body scroll when menu is open
            if (isOpen) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        });
        
        // Close menu when clicking navigation links
        const navLinks = mainNavigation.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                mobileMenuToggle.classList.remove('active');
                mainNavigation.classList.remove('mobile-menu-open');
                mobileMenuToggle.setAttribute('aria-expanded', 'false');
                document.body.style.overflow = '';
            });
        });
        
        // Close menu when clicking overlay
        mainNavigation.addEventListener('click', function(e) {
            if (e.target === mainNavigation) {
                mobileMenuToggle.classList.remove('active');
                mainNavigation.classList.remove('mobile-menu-open');
                mobileMenuToggle.setAttribute('aria-expanded', 'false');
                document.body.style.overflow = '';
            }
        });
    }
});
</script>
```

## **TESTING CHECKLIST**

### **Desktop Tests:**
- [ ] Dark header positions correctly on homepage
- [ ] White header positions correctly on inner pages  
- [ ] Logo sizes appropriately on both headers
- [ ] Navigation items align properly
- [ ] Buttons function correctly

### **Mobile Tests:**
- [ ] Burger menu appears on mobile
- [ ] Dark header shows white burger lines
- [ ] White header shows dark burger lines
- [ ] Menu overlay covers full screen
- [ ] Navigation links work in mobile menu
- [ ] CTA buttons work in mobile menu
- [ ] Menu closes when clicking links
- [ ] Menu closes when clicking overlay
- [ ] Burger animation works properly

### **Cross-Browser Tests:**
- [ ] Safari mobile
- [ ] Chrome mobile
- [ ] Firefox mobile
- [ ] Desktop browsers at mobile widths

**STEP 1: Emergency Cleanup (CRITICAL)**
```php
// FILE: /wp-content/themes/polaris-homepage/blocks/header-block.php
// REMOVE lines 191-312 (all inline CSS)
// DELETE everything from <style> to </style>

// RESULT: Clean PHP file with only HTML structure
```

```css
/* FILE: /wp-content/themes/polaris-homepage/style.css */
/* DELETE lines 5353-5686 - Complete broken mobile CSS section */
/* This removes all the conflicting mobile header CSS */

/* FIND: "/* Mobile Header and Navigation */" */  
/* DELETE: Everything from line 5353 to line 5686 */
/* KEEP: Line 5687+ (Hide burger menu on desktop rule) */
```

**STEP 2: Fix Desktop CSS Foundation (Lines 235-336)**
```css
/* FILE: /wp-content/themes/polaris-homepage/style.css */
/* MODIFY line 235-243: Change absolute positioning */

/* CURRENT (BROKEN): */
.homepage .header {
  display: inline-flex;
  align-items: center;
  gap: 94px;
  position: absolute;  /* ← BREAKS RESPONSIVE */
  top: 30px;          /* ← FIXED POSITION */
  left: 804px;        /* ← FIXED POSITION */
  background-color: transparent;
}

/* REPLACE WITH: */
.homepage .header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 20px;
  position: relative;    /* ← RESPONSIVE FRIENDLY */
  padding: 30px 60px;   /* ← FLEXIBLE PADDING */
  max-width: 1440px;    /* ← CONSTRAIN WIDTH */
  margin: 0 auto;       /* ← CENTER CONTENT */
  background-color: transparent;
  width: 100%;
  box-sizing: border-box;
}
```

**STEP 3: Add Mobile CSS (INSERT at line 5353)**
```css
/* FILE: /wp-content/themes/polaris-homepage/style.css */
/* INSERT after line 5352 (after hero mobile CSS) */

/* Mobile Header - Dark (Homepage) */
@media (max-width: 768px) {
  .homepage .header {
    flex-direction: column;
    align-items: flex-start;
    padding: 20px;
    gap: 15px;
  }
  
  /* Logo - responsive sizing */
  .homepage .polaris-logo {
    width: 180px;
    height: auto;
    align-self: flex-start;
  }
  
  /* Hide desktop navigation */
  .homepage .group-2 {
    display: none;
  }
  
  /* Show mobile burger menu */
  .homepage .mobile-menu-toggle {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    width: 30px;
    height: 22px;
    background: none;
    border: none;
    cursor: pointer;
    position: absolute;
    top: 20px;
    right: 20px;
  }
  
  .homepage .burger-line {
    width: 100%;
    height: 3px;
    background-color: white;
    border-radius: 2px;
    transition: all 0.3s ease;
  }
  
  /* Mobile dropdown menu */
  .homepage .group-2.mobile-menu-open {
    display: block;
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: rgba(44, 62, 80, 0.98);
    padding: 20px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.3);
  }
  
  .homepage .group-2.mobile-menu-open .frame-2 {
    flex-direction: column;
    gap: 0;
    width: 100%;
  }
  
  .homepage .group-2.mobile-menu-open .div-wrapper {
    width: 100%;
    padding: 12px 0;
    border-bottom: 1px solid rgba(255,255,255,0.1);
  }
  
  .homepage .group-2.mobile-menu-open .text-wrapper-2 a {
    color: white;
    font-size: 16px;
    display: block;
    width: 100%;
  }
  
  /* Mobile buttons */
  .homepage .group-2.mobile-menu-open .small-button,
  .homepage .group-2.mobile-menu-open .button-wrapper {
    position: relative;
    left: auto;
    top: auto;
    width: 100%;
    margin: 10px 0;
  }
  
  .homepage .group-2.mobile-menu-open .button-2 {
    width: 100%;
    padding: 12px 20px;
    text-align: center;
    font-size: 14px;
  }
  
  /* Burger menu animation */
  .homepage .mobile-menu-toggle.active .burger-line:nth-child(1) {
    transform: rotate(45deg) translate(6px, 6px);
  }
  
  .homepage .mobile-menu-toggle.active .burger-line:nth-child(2) {
    opacity: 0;
  }
  
  .homepage .mobile-menu-toggle.active .burger-line:nth-child(3) {
    transform: rotate(-45deg) translate(6px, -6px);
  }
}

/* Hide burger menu on desktop */
@media (min-width: 769px) {
  .mobile-menu-toggle {
    display: none !important;
  }
}
```

**STEP 4: Fix JavaScript (Repair existing)**
```javascript
// FILE: /wp-content/themes/polaris-homepage/blocks/header-block.php  
// CURRENT JavaScript is correct, just ensure it targets right elements

// VERIFY lines 115-139 contain:
const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
const mobileNavigation = document.querySelector('.frame-2');

// IF NOT, REPLACE with:
const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
const mobileNavigation = document.querySelector('#main-navigation');
```

#### Header Block (White) - `header-block-white.php`
**Current State**: CLEAN - Unmodified original  
**Complexity**: Medium  
**Used on**: Inner pages (pricing, about, contact, etc.)

**Structure Analysis**:
```php
<div class="pricing-page">
    <div class="header-innerpage">
        <header class="header">
            <img class="polaris-logo" src="polaris-logo-1.png" /> <!-- Different logo -->
            <div class="group"> <!-- Same nav structure -->
                <div class="frame"> <!-- Navigation items -->
                <div class="small-button"> <!-- Login -->
                <div class="button-wrapper"> <!-- Start Trial -->
            </div>
        </header>
    </div>
</div>
```

**Key Differences from Dark Header**:
- ✅ Simpler structure (no background wrapper)
- ✅ Uses `.header-innerpage` class instead of `.homepage .header`
- ✅ Different logo file (polaris-logo-1.png vs polaris-logo-1-1.png)
- ✅ White background, dark text
- ❌ NO mobile burger menu HTML
- ❌ NO responsive considerations

**Required Work**:
1. **Add burger menu HTML** (same as dark header)
2. **Implement responsive CSS** for `.header-innerpage`
3. **Ensure consistent mobile behavior** with dark header
4. **Test on all inner pages** (pricing, about, contact, features)

**DETAILED IMPLEMENTATION STEPS**:

**STEP 1: Add Mobile Menu HTML**
```php
// FILE: /wp-content/themes/polaris-homepage/blocks/header-block-white.php
// ADD after line 58 (after polaris-logo img tag):

          <!-- Mobile burger menu button -->
          <button class="mobile-menu-toggle" id="mobile-menu-toggle-white" aria-label="Toggle navigation menu">
              <span class="burger-line"></span>
              <span class="burger-line"></span>
              <span class="burger-line"></span>
          </button>

// MODIFY line 60 - ADD id attribute:
          <div class="group" id="main-navigation-white">
```

**STEP 2: Fix Desktop CSS (Lines 1857-1975)**
```css
/* FILE: /wp-content/themes/polaris-homepage/style.css */
/* MODIFY lines 1857-1862: Fix container width */

/* CURRENT (BROKEN): */
.header-innerpage {
  position: relative;
  width: 1440px;        /* ← BREAKS ON SMALLER SCREENS */
  height: 138px;
  background-color: #ffffff;
}

/* REPLACE WITH: */
.header-innerpage {
  position: relative;
  max-width: 1440px;    /* ← RESPONSIVE WIDTH */
  width: 100%;
  min-height: 138px;    /* ← FLEXIBLE HEIGHT */
  background-color: #ffffff;
  margin: 0 auto;       /* ← CENTER CONTENT */
  box-sizing: border-box;
}

/* MODIFY lines 1864-1872: Fix header positioning */
/* CURRENT (PROBLEMATIC): */
.header-innerpage .header {
  display: inline-flex;
  align-items: center;
  gap: 94px;
  position: relative;
  top: 24px;           /* ← FIXED POSITIONING */
  left: 69px;          /* ← FIXED POSITIONING */
  background-color: transparent;
}

/* REPLACE WITH: */
.header-innerpage .header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 20px;
  position: relative;
  padding: 24px 60px;  /* ← FLEXIBLE PADDING */
  background-color: transparent;
  width: 100%;
  box-sizing: border-box;
}
```

**STEP 3: Add Mobile CSS (INSERT after line 1975)**
```css
/* FILE: /wp-content/themes/polaris-homepage/style.css */
/* INSERT after .header-innerpage .button-wrapper (around line 1975) */

/* Mobile Header - White (Inner Pages) */
@media (max-width: 768px) {
  .header-innerpage {
    min-height: auto;
    padding: 0;
  }
  
  .header-innerpage .header {
    flex-direction: column;
    align-items: flex-start;
    padding: 20px;
    gap: 15px;
  }
  
  /* Logo - responsive sizing */
  .header-innerpage .polaris-logo {
    width: 180px;
    height: auto;
    align-self: flex-start;
  }
  
  /* Hide desktop navigation */
  .header-innerpage .group {
    display: none;
  }
  
  /* Show mobile burger menu */
  .header-innerpage .mobile-menu-toggle {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    width: 30px;
    height: 22px;
    background: none;
    border: none;
    cursor: pointer;
    position: absolute;
    top: 20px;
    right: 20px;
  }
  
  .header-innerpage .burger-line {
    width: 100%;
    height: 3px;
    background-color: var(--dark-grey);  /* ← DARK LINES FOR LIGHT BG */
    border-radius: 2px;
    transition: all 0.3s ease;
  }
  
  /* Mobile dropdown menu */
  .header-innerpage .group.mobile-menu-open {
    display: block;
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: rgba(255, 255, 255, 0.98);  /* ← WHITE BACKGROUND */
    border: 1px solid rgba(0,0,0,0.1);
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    padding: 20px;
  }
  
  .header-innerpage .group.mobile-menu-open .frame {
    flex-direction: column;
    gap: 0;
    width: 100%;
    position: relative;
    top: auto;
    left: auto;
  }
  
  .header-innerpage .group.mobile-menu-open .div-wrapper {
    width: 100%;
    padding: 12px 0;
    border-bottom: 1px solid rgba(0,0,0,0.1);
  }
  
  .header-innerpage .group.mobile-menu-open .text-wrapper a {
    color: var(--dark-grey);  /* ← DARK TEXT FOR LIGHT BG */
    font-size: 16px;
    display: block;
    width: 100%;
  }
  
  /* Mobile buttons */
  .header-innerpage .group.mobile-menu-open .small-button,
  .header-innerpage .group.mobile-menu-open .button-wrapper {
    position: relative;
    left: auto;
    top: auto;
    width: 100%;
    margin: 10px 0;
  }
  
  .header-innerpage .group.mobile-menu-open .button {
    width: 100%;
    padding: 12px 20px;
    text-align: center;
    font-size: 14px;
  }
  
  /* Burger menu animation */
  .header-innerpage .mobile-menu-toggle.active .burger-line:nth-child(1) {
    transform: rotate(45deg) translate(6px, 6px);
  }
  
  .header-innerpage .mobile-menu-toggle.active .burger-line:nth-child(2) {
    opacity: 0;
  }
  
  .header-innerpage .mobile-menu-toggle.active .burger-line:nth-child(3) {
    transform: rotate(-45deg) translate(6px, -6px);
  }
}
```

**STEP 4: Add JavaScript Functionality**
```php
// FILE: /wp-content/themes/polaris-homepage/blocks/header-block-white.php
// ADD before closing ?> tag (around line 95):

      <script>
      // Mobile menu toggle functionality for white header
      document.addEventListener('DOMContentLoaded', function() {
          const mobileMenuToggle = document.getElementById('mobile-menu-toggle-white');
          const mainNavigation = document.getElementById('main-navigation-white');
          
          if (mobileMenuToggle && mainNavigation) {
              mobileMenuToggle.addEventListener('click', function() {
                  mobileMenuToggle.classList.toggle('active');
                  mainNavigation.classList.toggle('mobile-menu-open');
                  
                  // Toggle aria-expanded for accessibility
                  const isOpen = mainNavigation.classList.contains('mobile-menu-open');
                  mobileMenuToggle.setAttribute('aria-expanded', isOpen);
              });
              
              // Close menu when clicking on navigation links
              const navLinks = mainNavigation.querySelectorAll('a');
              navLinks.forEach(link => {
                  link.addEventListener('click', function() {
                      mobileMenuToggle.classList.remove('active');
                      mainNavigation.classList.remove('mobile-menu-open');
                      mobileMenuToggle.setAttribute('aria-expanded', 'false');
                  });
              });
          }
      });
      </script>
```

**STEP 5: Testing Checklist**
- ✅ Test pricing page (/pricing)
- ✅ Test about page (/about)  
- ✅ Test contact page (/contact)
- ✅ Test features pages (/features)
- ✅ Test blog pages (/blog)
- ✅ Verify burger menu works on all pages
- ✅ Check mobile menu dropdown styling
- ✅ Test touch interactions on mobile devices

### 🔍 Hero Block - DETAILED AUDIT

#### Hero Block - `hero-block.php`
**Current State**: PARTIALLY RESPONSIVE - Has some mobile CSS but complex issues  
**Complexity**: VERY HIGH - Most complex block in the site  
**Used on**: Homepage only

**Structure Analysis**:
```php
<div class="homepage polaris-hero-section">
    <div class="hero">
        <div class="overlap"> <!-- MASSIVE 2910px width container -->
            <div class="ellipse"></div> <!-- Decorative blur element -->
            <img class="rocket-smoke" /> <!-- Decorative image -->
            <img class="hero-copy" /> <!-- Main dashboard illustration -->
            
            <div class="frame"> <!-- TEXT CONTENT CONTAINER -->
                <h1 class="text-wrapper">TITLE</h1>
                <p class="polaris-launchpad-AI">SUBTITLE</p>
                <div class="group"> <!-- CTA BUTTON GROUP -->
                    <div class="large-button">
                        <div class="overlap-group">
                            <div class="div"></div> <!-- Button background -->
                            <a class="button">CTA TEXT</a>
                        </div>
                    </div>
                    <p class="p">CTA SUBTEXT</p>
                </div>
            </div>
            
            <!-- MORE DECORATIVE IMAGES -->
            <img class="img" /> <!-- group-249.png -->
            <img class="group-3" /> <!-- group-248.png -->
            <img class="logo-icon-white" /> <!-- Small logo -->
        </div>
    </div>
</div>
```

**Critical Issues**:
- ❌ **Massive fixed width**: `.overlap { width: 2910px; left: -735px; }` - Causes horizontal scroll
- ❌ **Complex layered positioning**: 7+ absolutely positioned elements  
- ❌ **Fixed heights**: `height: 760px`, `height: 766px` don't adapt
- ❌ **Background image issues**: Multiple background layers with fixed sizes
- ✅ **SOME mobile CSS exists** (lines 5260-5351) but incomplete
- ❌ **Images don't scale properly** on mobile

**Existing Mobile CSS (PARTIAL)**:
```css
/* ALREADY EXISTS in style.css lines 5260-5351 */
@media (max-width: 767px) {
  .polaris-hero-section .hero {
    height: auto !important;
    min-height: 500px !important;
    padding: 40px 20px !important;
  }
  
  .polaris-hero-section .overlap {
    width: 100% !important; /* FIXES the 2910px issue */
    height: auto !important;
  }
  
  .polaris-hero-section .frame {
    /* Creates white card for content */
    background: rgba(255,255,255,0.9) !important;
    border-radius: 10px !important;
    text-align: center !important;
  }
  
  /* Hides problematic decorative elements */
  .polaris-hero-section .rocket-smoke { display: none !important; }
  .polaris-hero-section .ellipse { display: none !important; }
}
```

**What's Missing**:
1. **Background image scaling** - Needs proper responsive background
2. **Hero copy image positioning** - Main dashboard image positioning broken  
3. **Typography scaling** - Text needs better mobile sizing
4. **Button improvements** - CTA needs better mobile styling
5. **Spacing adjustments** - Padding and margins need refinement

**Required Components**:
1. **Background System** - Responsive gradient + image background
2. **Content Container** - Flexible content wrapper with proper centering
3. **Typography Component** - Properly scaled mobile typography  
4. **CTA Button Component** - Touch-friendly mobile button
5. **Image Management** - Show/hide/scale decorative elements appropriately

**Implementation Strategy**:
```
PHASE 1: Fix existing mobile CSS (IMPROVE, don't rebuild)
- Analyze existing mobile CSS at lines 5260-5351
- Fix background image scaling issues
- Improve typography and spacing
- Fix main hero-copy image positioning

PHASE 2: Enhance responsive behavior  
- Add tablet breakpoint (768-1024px)
- Improve background system scaling
- Better image management for different screen sizes
- Enhanced button and typography scaling

PHASE 3: Performance and polish
- Optimize image loading for mobile
- Add proper responsive images
- Smooth animations and transitions
- Test across all devices thoroughly
```

**Complexity Assessment**: 
- **Desktop CSS**: ~200 lines of complex positioning
- **Mobile CSS**: ~90 lines already exist but need refinement
- **Images**: 6 decorative images need responsive handling
- **Background**: Complex gradient + image background system
- **Priority**: HIGH (Hero is first thing users see)

---

## Phase 2: Navigation & Header (Priority: HIGH)
**Estimated Time**: 3-4 hours

### 2.1 Mobile Navigation Menu
**File**: `/wp-content/themes/polaris-homepage/blocks/header-block.php`

**Add mobile menu toggle HTML**:
```php
<button class="mobile-menu-toggle" aria-label="Toggle Menu">
  <span class="hamburger-line"></span>
  <span class="hamburger-line"></span>
  <span class="hamburger-line"></span>
</button>
```

### 2.2 Mobile Navigation CSS
```css
/* Hide desktop menu on mobile */
@media (max-width: 768px) {
  .header .frame-2 {
    display: none;
    position: fixed;
    top: 80px;
    left: 0;
    width: 100%;
    background: white;
    flex-direction: column;
    z-index: 9999;
  }
  
  .header .frame-2.mobile-open {
    display: flex;
  }
  
  /* Hide desktop buttons on mobile */
  .header .button-wrapper,
  .header .small-button {
    display: none;
  }
  
  /* Show hamburger menu */
  .mobile-menu-toggle {
    display: flex;
    flex-direction: column;
    width: 30px;
    height: 24px;
    background: none;
    border: none;
    cursor: pointer;
  }
  
  .hamburger-line {
    width: 100%;
    height: 3px;
    background: #2c3e50;
    margin: 2px 0;
    transition: 0.3s;
  }
}

/* Desktop - hide mobile menu */
@media (min-width: 769px) {
  .mobile-menu-toggle {
    display: none;
  }
}
```

### 2.3 Mobile Menu JavaScript
**File**: `/wp-content/themes/polaris-homepage/functions.php`

```php
function polaris_mobile_menu_script() {
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.querySelector('.mobile-menu-toggle');
        const menuItems = document.querySelector('.header .frame-2');
        
        if (menuToggle && menuItems) {
            menuToggle.addEventListener('click', function() {
                menuItems.classList.toggle('mobile-open');
            });
        }
    });
    </script>
    <?php
}
add_action('wp_footer', 'polaris_mobile_menu_script');
```

**Test Checkpoint**: Mobile navigation should work on devices under 768px

---

## Phase 3: Typography & Content (Priority: HIGH)
**Estimated Time**: 2-3 hours

### 3.1 Implement Existing Mobile Typography Variables
The theme already has mobile typography variables defined. Implement them:

```css
/* Mobile Typography Implementation */
@media (max-width: 768px) {
  h1, .text-wrapper {
    font-family: var(--polaris-h1-mobile-font-family) !important;
    font-size: var(--polaris-h1-mobile-font-size) !important;
    line-height: var(--polaris-h1-mobile-line-height) !important;
  }
  
  h2 {
    font-family: var(--polaris-h2-mobile-font-family) !important;
    font-size: var(--polaris-h2-mobile-font-size) !important;
    line-height: var(--polaris-h2-mobile-line-height) !important;
  }
  
  h3 {
    font-family: var(--polaris-h3-mobile-font-family) !important;
    font-size: var(--polaris-h3-mobile-font-size) !important;
    line-height: var(--polaris-h3-mobile-line-height) !important;
  }
  
  h4 {
    font-family: var(--polaris-h4-mobile-font-family) !important;
    font-size: var(--polaris-h4-mobile-font-size) !important;
    line-height: var(--polaris-h4-mobile-line-height) !important;
  }
  
  h5 {
    font-family: var(--polaris-h5-mobile-font-family) !important;
    font-size: var(--polaris-h5-mobile-font-size) !important;
    line-height: var(--polaris-h5-mobile-line-height) !important;
  }
}
```

### 3.2 Content Flow Adjustments
```css
@media (max-width: 768px) {
  /* Ensure content stacks properly */
  .frame {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 20px;
  }
  
  /* Improve text readability */
  p {
    line-height: 1.6;
    margin-bottom: 16px;
  }
}
```

**Test Checkpoint**: Typography should be readable and appropriately sized on mobile

---

## Phase 4: Hero Section Responsive (Priority: HIGH)
**Estimated Time**: 2-3 hours

### 4.1 Hero Layout Fixes
```css
@media (max-width: 768px) {
  .homepage .hero {
    height: auto;
    min-height: 80vh; /* Responsive height */
    padding: 40px 0;
  }
  
  .homepage .overlap {
    height: auto;
    min-height: 80vh;
    background-size: cover;
    background-position: center;
  }
  
  /* Center and stack hero content */
  .homepage .frame {
    position: relative;
    width: 100%;
    max-width: 100%;
    padding: 20px;
    text-align: center;
    margin: 0 auto;
  }
  
  /* Hero text improvements */
  .homepage .text-wrapper {
    font-size: 28px !important;
    line-height: 1.3 !important;
    margin-bottom: 16px;
  }
  
  .homepage .polaris-launchpad-AI {
    font-size: 16px !important;
    line-height: 1.5 !important;
    margin-bottom: 32px;
    max-width: 90%;
    margin-left: auto;
    margin-right: auto;
  }
}
```

### 4.2 Hide Complex Graphics on Mobile
```css
@media (max-width: 768px) {
  /* Hide decorative elements that don't work on mobile */
  .homepage .rocket-smoke,
  .homepage .img,
  .homepage .group-3,
  .homepage .logo-icon-white,
  .homepage .hero-copy {
    display: none !important;
  }
}
```

### 4.3 Mobile CTA Buttons
```css
@media (max-width: 768px) {
  .large-button {
    width: 100% !important;
    max-width: 280px;
    margin: 0 auto;
  }
  
  .button {
    padding: 16px 32px !important;
    font-size: 16px !important;
    width: 100%;
    display: block;
    text-align: center;
    min-height: 44px; /* Touch-friendly */
  }
  
  .group {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 16px;
  }
}
```

**Test Checkpoint**: Hero section should be clean and functional on mobile

---

## 🎯 PRICING BLOCK ANALYSIS

### PRICING BLOCK STATUS: ⚠️ PARTIAL IMPLEMENTATION
**File:** `/wp-content/themes/polaris-homepage/blocks/pricing-plans-block.php`

#### CRITICAL FINDINGS:
- **PARTIAL MOBILE CSS**: Lines 5529-5699 in style.css contain incomplete pricing mobile CSS
- **COMPLEX ABSOLUTE POSITIONING**: Multiple nested groups with absolute positioning
- **PRICING CARDS**: Three-column layout needs mobile stacking
- **EXISTING PARTIAL CSS**: Some mobile styles exist but are incomplete

#### Current Partial Mobile CSS (lines 5529-5699):
```css
/* Mobile Pricing Plans */
.wp-block-polaris-pricing-plans .pricing-page {
  width: 100% !important;
  height: auto !important;
  padding: 40px 20px !important;
  /* ... partial implementation exists ... */
}
```

#### REQUIRED COMPLETION:
**File:** `/wp-content/themes/polaris-homepage/style.css`
**MODIFY lines 5529-5699** - Complete the existing partial implementation:
```css
/* Complete Mobile Pricing Plans CSS */
@media (max-width: 768px) {
  .wp-block-polaris-pricing-plans .pricing-page {
    width: 100% !important;
    height: auto !important;
    padding: 40px 20px !important;
    overflow: visible !important;
    position: relative !important;
  }
  
  /* Hide all background decorative elements */
  .wp-block-polaris-pricing-plans .pricing-page .vector,
  .wp-block-polaris-pricing-plans .pricing-page .img,
  .wp-block-polaris-pricing-plans .pricing-page .vector-2,
  .wp-block-polaris-pricing-plans .pricing-page .logo-icon,
  .wp-block-polaris-pricing-plans .pricing-page .group-2,
  .wp-block-polaris-pricing-plans .pricing-page .group-3,
  .wp-block-polaris-pricing-plans .pricing-page .group-4 {
    display: none !important;
  }
  
  /* Main pricing container */
  .wp-block-polaris-pricing-plans .pricing-page .overlap {
    position: relative !important;
    height: auto !important;
    width: 100% !important;
  }
  
  .wp-block-polaris-pricing-plans .pricing-page .group {
    position: relative !important;
    width: 100% !important;
    height: auto !important;
  }
  
  .wp-block-polaris-pricing-plans .pricing-page .frame {
    flex-direction: column !important;
    align-items: center !important;
    gap: 30px !important;
    width: 100% !important;
    position: relative !important;
  }
  
  /* Individual pricing cards - make them stack */
  .wp-block-polaris-pricing-plans .pricing-page .div,
  .wp-block-polaris-pricing-plans .pricing-page .overlap-4,
  .wp-block-polaris-pricing-plans .pricing-page .overlap-3,
  .wp-block-polaris-pricing-plans .pricing-page .div-2 {
    position: relative !important;
    width: 100% !important;
    max-width: 350px !important;
    height: auto !important;
    margin: 0 auto 20px auto !important;
    padding: 30px 20px !important;
    background: white !important;
    border: 2px solid #e0e0e0 !important;
    border-radius: 12px !important;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1) !important;
  }
  
  /* Plan headers and pricing */
  .wp-block-polaris-pricing-plans .pricing-page .overlap-group,
  .wp-block-polaris-pricing-plans .pricing-page .overlap-group-5,
  .wp-block-polaris-pricing-plans .pricing-page .overlap-group-wrapper {
    position: relative !important;
    width: 100% !important;
    height: auto !important;
    text-align: center !important;
    margin-bottom: 20px !important;
  }
  
  .wp-block-polaris-pricing-plans .pricing-page .text-wrapper,
  .wp-block-polaris-pricing-plans .pricing-page .text-wrapper-4,
  .wp-block-polaris-pricing-plans .pricing-page .text-wrapper-6 {
    font-size: 20px !important;
    margin-bottom: 10px !important;
    position: relative !important;
  }
  
  .wp-block-polaris-pricing-plans .pricing-page .text-wrapper-2,
  .wp-block-polaris-pricing-plans .pricing-page .text-wrapper-5,
  .wp-block-polaris-pricing-plans .pricing-page .text-wrapper-7 {
    font-size: 28px !important;
    color: var(--flare-orange) !important;
    font-weight: bold !important;
    position: relative !important;
  }
  
  /* Buttons - make them full width */
  .wp-block-polaris-pricing-plans .pricing-page .small-button,
  .wp-block-polaris-pricing-plans .pricing-page .button-wrapper {
    position: relative !important;
    width: 100% !important;
    margin: 10px 0 !important;
  }
  
  .wp-block-polaris-pricing-plans .pricing-page .button {
    width: 100% !important;
    padding: 15px 20px !important;
    text-align: center !important;
    font-size: 16px !important;
    border-radius: 8px !important;
  }
}
```

**STATUS**: ⚠️ Needs Completion - Expand existing partial mobile CSS

---

## 🎯 FEATURES BLOCKS ANALYSIS

### FEATURES BLOCKS STATUS: ❌ NEEDS IMPLEMENTATION
**Files:** 
- `/wp-content/themes/polaris-homepage/blocks/features-section1-block.php`
- `/wp-content/themes/polaris-homepage/blocks/features-section2-block.php` 
- `/wp-content/themes/polaris-homepage/blocks/features-section3-block.php`
- `/wp-content/themes/polaris-homepage/blocks/features-section4-block.php`

#### CRITICAL FINDINGS:
- **NO MOBILE CSS**: Features blocks have no responsive CSS implementation
- **ABSOLUTE POSITIONING**: Uses complex absolute positioning that will break on mobile
- **MULTIPLE DECORATIVE IMAGES**: Contains background vectors that need mobile handling
- **COMPLEX LAYOUT**: Text + image combinations need mobile restructuring

#### Features Section 1 Analysis:
**Current Structure:**
```php
<section class="features-section">
  <div class="overlap-group">
    <img class="vector" />          <!-- Background decoration */
    <img class="img" />            /* Background decoration */
    <img class="hero-copy" />      /* Main illustration */
    <div class="group">           /* Text content */
      <h1 class="your-business-hub">Your Business Hub:<br />The AI's Knowledge Center</h1>
      <p class="think-of-your">Think of your Business Hub as your AI's brain...</p>
    </div>
    <img class="vector-2" />       /* Background decoration */
    <img class="logo-icon" />     /* Logo decoration */
  </div>
</section>
```

#### REQUIRED MOBILE CSS FOR FEATURES:
**File:** `/wp-content/themes/polaris-homepage/style.css`
**INSERT after hero mobile CSS (around line 5352):**
```css
/* Features Blocks Mobile CSS */
@media (max-width: 768px) {
  /* Features Section 1 */
  .wp-block-polaris-features-section1 .features-section {
    padding: 40px 20px;
    min-height: auto;
    overflow: visible;
  }
  
  .wp-block-polaris-features-section1 .overlap-group {
    position: relative;
    width: 100%;
    height: auto;
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  
  /* Hide decorative background images on mobile */
  .wp-block-polaris-features-section1 .vector,
  .wp-block-polaris-features-section1 .img,
  .wp-block-polaris-features-section1 .vector-2,
  .wp-block-polaris-features-section1 .logo-icon {
    display: none;
  }
  
  /* Main illustration - make responsive */
  .wp-block-polaris-features-section1 .hero-copy {
    position: relative;
    width: 100%;
    max-width: 350px;
    height: auto;
    margin-bottom: 30px;
    z-index: 1;
  }
  
  /* Text content container */
  .wp-block-polaris-features-section1 .group {
    position: relative;
    width: 100%;
    text-align: center;
    padding: 20px;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
  }
  
  /* Heading responsive */
  .wp-block-polaris-features-section1 .your-business-hub {
    font-size: 24px;
    line-height: 1.3;
    margin-bottom: 20px;
  }
  
  /* Paragraph responsive */
  .wp-block-polaris-features-section1 .think-of-your {
    font-size: 16px;
    line-height: 1.5;
    margin: 0;
  }
  
  /* Similar patterns for Features Section 2, 3, 4 */
  .wp-block-polaris-features-section2,
  .wp-block-polaris-features-section3,
  .wp-block-polaris-features-section4 {
    /* Apply same mobile patterns */
  }
}
```

**STATUS**: ❌ Needs Implementation - Mobile CSS required for all 4 features sections

---

## 🦶 FOOTER BLOCK ANALYSIS

### FOOTER BLOCK STATUS: ❌ NEEDS IMPLEMENTATION
**File:** `/wp-content/themes/polaris-homepage/blocks/footer-block.php`

#### CRITICAL FINDINGS:
- **NO MOBILE CSS**: Footer has no responsive implementation
- **COMPLEX GRID LAYOUT**: Multi-column footer with company info, links, social media
- **ABSOLUTE POSITIONING**: Uses absolute positioning that breaks on mobile
- **BACKGROUND ELEMENTS**: Contains decorative backgrounds that need mobile handling

#### REQUIRED MOBILE CSS FOR FOOTER:
**File:** `/wp-content/themes/polaris-homepage/style.css`
**INSERT after pricing mobile CSS (around line 5700):**
```css
/* Footer Mobile CSS */
@media (max-width: 768px) {
  .wp-block-polaris-footer .footer {
    padding: 40px 20px !important;
    min-height: auto !important;
    position: relative !important;
  }
  
  /* Hide decorative background elements */
  .wp-block-polaris-footer .vector,
  .wp-block-polaris-footer .img,
  .wp-block-polaris-footer .vector-2,
  .wp-block-polaris-footer .logo-icon,
  .wp-block-polaris-footer .ellipse {
    display: none !important;
  }
  
  /* Footer main container */
  .wp-block-polaris-footer .overlap,
  .wp-block-polaris-footer .overlap-group {
    position: relative !important;
    width: 100% !important;
    height: auto !important;
  }
  
  /* Footer content - stack vertically */
  .wp-block-polaris-footer .group,
  .wp-block-polaris-footer .frame {
    flex-direction: column !important;
    align-items: center !important;
    text-align: center !important;
    gap: 30px !important;
    width: 100% !important;
    position: relative !important;
  }
  
  /* Logo section */
  .wp-block-polaris-footer .polaris-logo {
    width: 200px !important;
    height: auto !important;
    margin-bottom: 20px !important;
  }
  
  /* Navigation links - stack vertically */
  .wp-block-polaris-footer .div-wrapper {
    width: 100% !important;
    margin: 10px 0 !important;
  }
  
  .wp-block-polaris-footer .text-wrapper a {
    font-size: 16px !important;
    display: block !important;
    padding: 10px !important;
    border-bottom: 1px solid rgba(255,255,255,0.1) !important;
  }
  
  /* Social media icons */
  .wp-block-polaris-footer .social-icons {
    display: flex !important;
    justify-content: center !important;
    gap: 20px !important;
    margin: 20px 0 !important;
  }
  
  /* Copyright and legal */
  .wp-block-polaris-footer .copyright {
    font-size: 14px !important;
    text-align: center !important;
    margin-top: 30px !important;
    padding-top: 20px !important;
    border-top: 1px solid rgba(255,255,255,0.1) !important;
  }
}
```

**STATUS**: ❌ Needs Implementation - No mobile CSS exists

---

## Phase 5: Block-by-Block Responsive (Priority: MEDIUM)
**Estimated Time**: 4-6 hours

### 5.1 Features Sections (4 blocks to update)
Each features section needs:
```css
@media (max-width: 768px) {
  .features-section .frame {
    flex-direction: column !important;
    text-align: center;
  }
  
  .features-section .feature-item {
    width: 100% !important;
    margin-bottom: 32px;
  }
  
  .features-section img {
    max-width: 80%;
    height: auto;
    margin: 0 auto 16px auto;
  }
}
```

### 5.2 Pricing Block
**File**: `/wp-content/themes/polaris-homepage/blocks/pricing-plans-block.php`

```css
@media (max-width: 768px) {
  .pricing-plans .frame {
    flex-direction: column !important;
    gap: 24px;
  }
  
  .pricing-card {
    width: 100% !important;
    max-width: 350px;
    margin: 0 auto;
  }
  
  /* Ensure pricing toggle still works */
  .pricing-toggle {
    width: 100%;
    max-width: 300px;
    margin: 0 auto 32px auto;
  }
}
```

### 5.3 About Us Block
```css
@media (max-width: 768px) {
  .about-section {
    padding: 40px 16px;
  }
  
  .about-content {
    flex-direction: column;
    text-align: center;
  }
  
  .about-image {
    order: -1; /* Image first on mobile */
    margin-bottom: 24px;
  }
}
```

### 5.4 Contact Form Block
```css
@media (max-width: 768px) {
  .contact-form {
    padding: 40px 16px;
  }
  
  .contact-form input,
  .contact-form textarea {
    width: 100%;
    padding: 16px;
    font-size: 16px; /* Prevent zoom on iOS */
    margin-bottom: 16px;
  }
  
  .contact-form button {
    width: 100%;
    padding: 16px;
    min-height: 44px;
  }
}
```

**Test Checkpoint**: All major content blocks should stack properly on mobile

---

## Phase 6: Footer & Final Polish (Priority: LOW)
**Estimated Time**: 2-3 hours

### 6.1 Footer Responsive
```css
@media (max-width: 768px) {
  .footer {
    padding: 40px 16px;
  }
  
  .footer-content {
    flex-direction: column !important;
    text-align: center;
    gap: 32px;
  }
  
  .footer-column {
    width: 100% !important;
    margin-bottom: 24px;
  }
  
  .footer-logo {
    order: -1;
    margin-bottom: 24px;
  }
}
```

### 6.2 Image Optimization
```css
/* Make all images responsive */
img {
  max-width: 100%;
  height: auto;
}

/* Specific image containers */
@media (max-width: 768px) {
  .image-container {
    text-align: center;
    margin: 16px 0;
  }
  
  .hero-image,
  .feature-image,
  .section-image {
    max-width: 90%;
    margin: 0 auto;
  }
}
```

**Test Checkpoint**: Footer and images should look good on all devices

---

## Phase 7: Interactive Elements & JavaScript (Priority: MEDIUM)
**Estimated Time**: 2-3 hours

### 7.1 FAQ Accordion Mobile Improvements
```css
@media (max-width: 768px) {
  .faq-item {
    margin-bottom: 16px;
  }
  
  .faq-question {
    padding: 16px;
    font-size: 16px;
    min-height: 44px; /* Touch-friendly */
  }
  
  .faq-answer {
    padding: 16px;
    line-height: 1.6;
  }
}
```

### 7.2 Pricing Toggle Mobile
Ensure the existing pricing toggle JavaScript works on mobile:
- Test touch interactions
- Verify visual feedback
- Ensure buttons are large enough (44px minimum)

### 7.3 Form Validations
Ensure all forms work properly on mobile:
- Contact forms
- Newsletter signups
- CTA buttons

**Test Checkpoint**: All interactive elements should work smoothly on touch devices

---

## 📱 TESTING BREAKPOINTS

### Primary Breakpoints:
- **Mobile**: 320px - 767px
- **Tablet**: 768px - 1023px  
- **Desktop**: 1024px - 1439px
- **Large Desktop**: 1440px+

### Secondary Breakpoints (if needed):
- **Small Mobile**: 320px - 480px
- **Large Mobile**: 481px - 767px
- **Small Tablet**: 768px - 1023px
- **Large Tablet**: 1024px - 1199px

---

## 🧪 TESTING CHECKLIST

### After Each Phase:
- [ ] Test on Chrome DevTools device simulation
- [ ] Test actual mobile devices if available
- [ ] Check landscape and portrait orientations
- [ ] Verify touch targets are 44px+ minimum
- [ ] Test navigation functionality
- [ ] Verify forms work properly
- [ ] Check image loading and scaling
- [ ] Test JavaScript interactions

### Critical User Journeys to Test:
- [ ] **Navigation**: Can users access all pages?
- [ ] **CTA Buttons**: Can users easily click "Start Free Trial"?
- [ ] **Contact Form**: Can users submit inquiries?
- [ ] **Pricing**: Can users view and compare plans?
- [ ] **About**: Can users learn about the company?

### Device Testing Priority:
1. **iPhone (various sizes)** - Primary mobile target
2. **Android phones** - Secondary mobile target  
3. **iPad** - Tablet experience
4. **Desktop** - Ensure nothing breaks

---

## 🚀 IMPLEMENTATION WORKFLOW

### Pre-Implementation:
1. **Backup staging site** CSS files
2. **Create git branch** for responsive changes
3. **Document current state** with screenshots

### During Implementation:
1. **Work in phases** - complete one phase before moving to next
2. **Test after each major change**
3. **Take screenshots** of progress
4. **Commit changes regularly** to git

### Post-Implementation:
1. **Comprehensive cross-device testing**
2. **Performance testing** (mobile loading speed)
3. **Accessibility testing** (keyboard navigation, screen readers)
4. **User acceptance testing** with stakeholder
5. **Deploy to production** when approved

---

## ⚠️ CRITICAL SUCCESS FACTORS

### Must-Haves:
✅ **Site loads properly** on mobile devices  
✅ **Navigation is usable** on touch devices  
✅ **Text is readable** without zooming  
✅ **Buttons are touch-friendly** (44px minimum)  
✅ **Forms work properly** on mobile  
✅ **Performance remains good** (loading speed)  

### Nice-to-Haves:
- Enhanced mobile animations
- Touch gestures (swipe, pinch)
- Mobile-specific features
- Progressive Web App features

---

## 📂 FILES TO MODIFY

### Primary Files:
1. **`/wp-content/themes/polaris-homepage/style.css`** - Main responsive CSS
2. **`/wp-content/themes/polaris-homepage/functions.php`** - Mobile menu JavaScript
3. **`/wp-content/themes/polaris-homepage/blocks/header-block.php`** - Mobile navigation HTML

### Secondary Files (per block):
- **`blocks/hero-block.php`** - Hero section
- **`blocks/features-section*-block.php`** - Features blocks (4 files)
- **`blocks/pricing-plans-block.php`** - Pricing section
- **`blocks/footer-block.php`** - Footer
- **`blocks/contact-us-form-block.php`** - Contact form

### Support Files:
- **`globals.css`** - Base responsive utilities
- **`styleguide.css`** - Already contains mobile typography variables

---

## 🎯 EXPECTED OUTCOMES

### Immediate Benefits:
- **60%+ of traffic** (mobile users) can properly use the site
- **Improved SEO** from mobile-friendly status
- **Better user experience** across all devices
- **Professional appearance** on mobile devices

### Long-term Benefits:
- **Higher conversion rates** from mobile traffic
- **Improved Google rankings** (mobile-first indexing)
- **Future-proof design** for new devices
- **Easier maintenance** with responsive framework

---

## 📋 ROLLBACK PLAN

### If Issues Arise:
1. **Staging site allows safe testing** - no impact on production
2. **CSS backups created** before each phase
3. **Git versioning** tracks all changes
4. **Quick rollback** possible by restoring backup CSS files

### Emergency Rollback:
```bash
# Restore original CSS
cp style.css.backup style.css
# Clear any caches
# Test production site
```

---

**Last Updated**: January 27, 2026  
**Implementation Status**: Ready to begin  
**Estimated Total Time**: 15-20 hours across 7 phases  
**Priority**: High - Mobile traffic represents 60%+ of visitors

---

*This document will be updated as implementation progresses. All changes should be tested on staging site before production deployment.*