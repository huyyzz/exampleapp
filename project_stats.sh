#!/bin/bash

echo "Thống kê chi tiết dự án Laravel"
echo

printf "%-12s %-15s %-15s %-15s %-15s\n" "Thư mục" "Số file nguồn" "Dòng code" "Số lớp" "Dung lượng (MB)"

folders=("app" "config" "database" "resources" "routes" "public" "tests" "vendor")

for dir in "${folders[@]}"; do
  if [ -d "$dir" ]; then
    files=$(find "$dir" -type f | wc -l)
    lines=$(find "$dir" -type f \( -name '*.php' -o -name '*.js' -o -name '*.blade.php' \) -print0 | xargs -0 cat 2>/dev/null | wc -l)
    classes=$(grep -r "class " "$dir" --include=*.php 2>/dev/null | wc -l)
    size=$(du -sm "$dir" | cut -f1)
    printf "%-12s %-15s %-15s %-15s %-15s\n" "$dir/" "$files" "$lines" "$classes" "$size"
  else
    printf "%-12s %-15s %-15s %-15s %-15s\n" "$dir/" "0" "0" "0" "0"
  fi
done

# Thống kê các file cấp cao khác (không thuộc thư mục trên)
top_files=$(find . -maxdepth 1 -type f | wc -l)
top_lines=$(find . -maxdepth 1 -type f \( -name '*.php' -o -name '*.js' \) -print0 | xargs -0 cat 2>/dev/null | wc -l)
top_classes=$(grep -r "class " . --include=*.php --max-depth=1 2>/dev/null | wc -l)
top_size=$(du -sm . | cut -f1)
printf "%-12s %-15s %-15s %-15s %-15s\n" "Khác" "$top_files" "$top_lines" "$top_classes" "$top_size"

read -p "Nhấn Enter để thoát..."
