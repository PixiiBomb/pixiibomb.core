<?php

namespace PixiiBomb\Core\Enums;

enum ConsoleColors: string
{
    // Brand
    case PRIMARY = '38;5;205';                 // Hot Pink
    case SECONDARY = '38;5;219';               // Bubblegum Pink

    // Text
    case TEXT = '38;5;255';                    // Soft Off-White
    case MUTED = '38;5;248';                   // Light Gray
    case SUBTLE = '38;5;245';                  // Muted Gray

    // Status
    case SUCCESS = '38;5;121';                 // Mint Green
    case INFO = '38;5;117';                    // Sky Blue
    case CAUTION = '38;5;222';                 // Soft Gold
    case WARNING = '38;5;209';                 // Coral Orange
    case ERROR = '38;5;197';                   // Bright Red-Pink

    // Progress/UI
    case PROGRESS_BAR_BACKGROUND = '38;5;238';// Dark Gray
}
