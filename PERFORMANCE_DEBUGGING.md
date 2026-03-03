# 🔧 Performance Debugging Guide - Loading 9-12 seconds

## 📊 Testing Loading Time Breakdown

Untuk identify exact bottleneck, ikuti langkah ini:

### **Langkah 1: Use Browser DevTools Timing**

1. **Open DevTools** → F12
2. **Go to Network tab**
3. **Disable Cache** (check "Disable cache" checkbox)
4. **Reload** → Ctrl+Shift+R (hard refresh)
5. **Check timing breakdown:**

```
Metrics to Check:
- DNS Lookup: < 100ms
- TCP Connect: < 100ms  
- TLS Handshake: < 200ms (if HTTPS)
- Request sent: < 100ms
- Waiting (TTFB): < 500ms ⭐ CRITICAL
- Content Download: Should be fast
- DOMContentLoaded: Should appear early
- Load Complete: Final metric
```

**If "Waiting" > 500ms** → Server is slow (PHP/Database)  
**If "Content Download" slow** → Assets too large  
**If DOMContentLoaded is at end** → JavaScript blocking

---

## 🔍 **Server-Side Debugging**

### Check Database Performance

```bash
# Run in tinker
php artisan tinker

# Check slow queries
>>> \DB::enableQueryLog();
>>> \Illuminate\Support\Facades\Cache::flush();
>>> $news = \App\Models\News::where('status', 'published')->limit(3)->get();
>>> \DB::getQueryLog();
```

Expected time: **< 50ms per query**

---

### Check Cache Is Working

```bash
# Load homepage multiple times - should be faster on second load
# Look at X-Cache header in Network tab:
# X-Cache: MISS (first time)
# X-Cache: HIT (second time)
```

---

## 📊 Load Testing Scenarios

### Scenario 1: First Load (No Cache)
- **Expected**: 3-5 seconds
- **What to check**: Database + asset download

### Scenario 2: Second Load (Cache Hit)
- **Expected**: < 1 second
- **What to check**: Cache is working, asset from browser cache

### Scenario 3: Hard Refresh (No Cache)
- **Expected**: 3-5 seconds again
- **What to check**: Application cache should kick in

---

## 🚀 **Quick Performance Checklist**

- ✅ Database indexes added?
  ```bash
  php artisan migrate
  ```

- ✅ Caches warmed up?
  ```bash
  php artisan website:optimize
  ```

- ✅ Page response caching active?
  - Check `X-Cache: HIT/MISS` header

- ✅ Assets loading fast?
  - CSS: ~17 KB (gzipped)
  - JS: ~14 KB (gzipped)

- ✅ Images lazy-loading?
  - Should see `loading="lazy"` in img tags

---

## 🎯 **Common Issues & Solutions**

### Issue 1: Still Getting 9-12 Seconds?
**Probable causes:**
1. Database slow queries (no indexes)
2. Page cache not working
3. Large assets not compressed
4. Livewire overhead

**Solution:**
```bash
# Check cache working
php artisan cache:forget home.latest_news

# Rebuild with current assets
npm run build

# Verify indexes exist
php artisan migrate
```

### Issue 2: First paint is slow but load fast after?
**Probable cause:** Page cache warmed up on second load

**Solution:** Normal behavior, caches work as intended

### Issue 3: Cache says "HIT" but still slow?
**Probable causes:**
1. Assets not compressed (check GZIP)
2. Images not optimized
3. Too many blocking scripts

**Solution:** Check Network tab → Size column should show small numbers

---

## 📈 Expected Performance After Optimization

| Load Type | Before | After | Target |
|-----------|--------|-------|--------|
| **First Load** | 8-12s | 3-5s | ✅ |
| **Cached Load** | 8-12s | < 1s | ✅ **ULTRA FAST** |
| **Hard Refresh** | 8-12s | 3-5s | ✅ |
| **Assets Size** | 200+ KB | 32 KB | ✅ |
| **Database Queries** | 7+ | 1-2 | ✅ |
| **TTFB** | > 2s | < 500ms | ✅ |

---

## 🔍 **Advanced Profiling**

### Method 1: Check Laravel Logs
```bash
tail -f storage/logs/laravel.log

# Should see slow query logs (> 100ms queries)
```

### Method 2: Check Cache Hit Rate
```bash
# In tinker:
>>> \Illuminate\Support\Facades\Cache::tags('home')->flush();
>>> \Illuminate\Support\Facades\Cache::tags('home')->remember(...);
```

### Method 3: Use Chrome Performance Tab
1. DevTools → Performance tab
2. Click Record
3. Reload page
4. Wait for load complete
5. Stop recording
6. Analyze timeline

---

## ✅ **Performance Improvements Applied**

1. ✅ **Page-level response caching** - CachePageResponse middleware
2. ✅ **Database indexes** - Added for all main queries
3. ✅ **Column selection** - Select only needed columns
4. ✅ **Aggressive caching** - Shorter cache durations where appropriate
5. ✅ **File storage optimization** - Symlink fixed
6. ✅ **GZIP compression** - .htaccess configured
7. ✅ **Browser caching** - Assets cached 1 year

---

## 🎓 **If Still Slow After Everything**

Try these nuclear options:

### Option 1: Enable Query Caching
Add to MySQL config (if you have access):
```
query_cache_size = 128M
query_cache_type = ON
```

### Option 2: Use Redis Cache
```bash
# Install Redis (if available)
CACHE_STORE=redis  # in .env

# The CachePageResponse middleware will use Redis automatically
```

### Option 3: Pre-render Pages  
Create static HTML version of homepage and serve directly

### Option 4: Upgrade Server
- More RAM
- Better CPU
- SSD storage

---

**Last Updated**: March 4, 2026  
**Status**: Advanced Optimization Complete
