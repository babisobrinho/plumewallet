# Table Ellipsis Feature

This document describes the ellipsis functionality added to the data table component to prevent text overflow in table columns.

## 🎯 Features

### Automatic Title Column Ellipsis
- **Title columns** automatically get ellipsis styling
- **Tooltip support** - hover to see full text
- **Responsive design** - adjusts width based on screen size

### Manual Ellipsis Control
- **`ellipsis` property** - Add to any column definition to enable ellipsis
- **Flexible styling** - Different max-widths for different column types
- **Responsive breakpoints** - Automatically adjusts on smaller screens

## 🚀 Usage

### Automatic (Title Columns)
Title columns automatically get ellipsis styling:

```php
// In your Livewire component
public function getTableColumnsProperty()
{
    return [
        [
            'key' => 'title',
            'label' => 'Title',
            'sortable' => true,
        ],
        // ... other columns
    ];
}
```

### Manual (Any Column)
Add `'ellipsis' => true` to any column definition:

```php
// In your Livewire component
public function getTableColumnsProperty()
{
    return [
        [
            'key' => 'description',
            'label' => 'Description',
            'ellipsis' => true, // Enable ellipsis for this column
        ],
        [
            'key' => 'long_text',
            'label' => 'Long Text',
            'ellipsis' => true,
            'cellClass' => 'text-gray-600', // Optional: custom styling
        ],
        // ... other columns
    ];
}
```

## 🎨 CSS Classes

### `.title-cell`
- **Max-width**: 300px (desktop), 200px (tablet), 150px (mobile)
- **Min-width**: 150px
- **Features**: Ellipsis, tooltip support, responsive

### `.ellipsis-cell`
- **Max-width**: 250px (desktop), 180px (tablet), 120px (mobile)
- **Min-width**: 100px
- **Features**: General ellipsis styling for any column

### `.text-ellipsis`
- **Max-width**: 200px
- **Features**: Basic ellipsis styling

## 📱 Responsive Design

### Desktop (>768px)
- Title columns: 300px max-width
- Ellipsis columns: 250px max-width

### Tablet (≤768px)
- Title columns: 200px max-width
- Ellipsis columns: 180px max-width

### Mobile (≤640px)
- Title columns: 150px max-width
- Ellipsis columns: 120px max-width

## 🔧 Customization

### Custom Max-Width
You can override the max-width by adding custom CSS:

```css
.table-responsive .title-cell {
    max-width: 400px; /* Custom width */
}

.table-responsive .ellipsis-cell {
    max-width: 300px; /* Custom width */
}
```

### Custom Cell Styling
Combine with custom cell classes:

```php
[
    'key' => 'description',
    'label' => 'Description',
    'ellipsis' => true,
    'cellClass' => 'text-gray-600 font-medium', // Custom styling
],
```

## 📋 Examples

### Blog Posts Table
```php
public function getTableColumnsProperty()
{
    return [
        [
            'key' => 'title',
            'label' => 'Title',
            'sortable' => true,
            // Automatically gets ellipsis
        ],
        [
            'key' => 'excerpt',
            'label' => 'Excerpt',
            'ellipsis' => true, // Manual ellipsis
        ],
        [
            'key' => 'author',
            'label' => 'Author',
            // No ellipsis - normal column
        ],
    ];
}
```

### Users Table
```php
public function getTableColumnsProperty()
{
    return [
        [
            'key' => 'name',
            'label' => 'Name',
            'sortable' => true,
            // Automatically gets ellipsis if key is 'title'
        ],
        [
            'key' => 'email',
            'label' => 'Email',
            'ellipsis' => true, // Manual ellipsis
        ],
        [
            'key' => 'phone',
            'label' => 'Phone',
            // No ellipsis
        ],
    ];
}
```

## 🎯 Benefits

1. **Prevents Table Overflow** - Long text doesn't break table layout
2. **Better UX** - Users can hover to see full text
3. **Responsive Design** - Adapts to different screen sizes
4. **Flexible** - Can be applied to any column
5. **Automatic** - Title columns get ellipsis by default
6. **Customizable** - Easy to override with custom CSS

## 🔍 How It Works

1. **Detection**: The component checks if a column has `'ellipsis' => true` or if the key is `'title'`
2. **CSS Application**: Applies the appropriate CSS class (`title-cell` or `ellipsis-cell`)
3. **Tooltip**: For title columns, adds a `title` attribute with the full text
4. **Responsive**: CSS media queries adjust the max-width based on screen size

## 🐛 Troubleshooting

### Ellipsis Not Working
- Check if the column has `'ellipsis' => true` or key is `'title'`
- Ensure CSS is compiled: `npm run build`
- Verify the column key matches exactly

### Text Still Overflowing
- Check if there are conflicting CSS rules
- Ensure the parent container has proper width constraints
- Try adding `!important` to the ellipsis CSS if needed

### Tooltip Not Showing
- Ensure the column key is exactly `'title'`
- Check if the text is actually truncated
- Verify the `title` attribute is being set correctly
