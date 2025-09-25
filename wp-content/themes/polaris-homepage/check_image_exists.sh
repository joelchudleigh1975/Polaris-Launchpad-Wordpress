 # Check if image exists on server before upload
    # Usage: ./check_image_exists.sh filename.png
    # Repository: https://github.com/joelchudleigh1975/Polaris-Launchpad

    if [ $# -eq 0 ]; then
        echo "Usage: ./check_image_exists.sh <filename>"
        echo "Example: ./check_image_exists.sh mask-group.png"
        exit 1
    fi

    FILENAME="$1"
    SERVER="root@159.69.15.0"
    IMG_PATH="/var/www/wordpress/wp-content/themes/polaris-homepage/img"

    echo "Checking if $FILENAME exists on server..."

    if ssh $SERVER "ls -la $IMG_PATH/$FILENAME" 2>/dev/null; then
        echo ""
        echo "⚠️  WARNING: $FILENAME ALREADY EXISTS!"
        echo "🚫 DO NOT UPLOAD - will overwrite existing file"
        echo "💡 Consider renaming to ${FILENAME%.*}_v2.${FILENAME##*.}"
    else
        echo ""
        echo "✅ Safe to upload $FILENAME"
        echo "📤 Use: scp \"$FILENAME\" $SERVER:$IMG_PATH/"
    fi
