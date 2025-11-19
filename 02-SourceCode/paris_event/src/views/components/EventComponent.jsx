// src/views/components/EventComponent.jsx
import React, { useState } from "react";
import PropTypes from "prop-types";
import TimerComponent from "./TimerComponent";
import EventType from "../../utils/enums/EventType";

/**
 * Event component
 * Props:
 *  - event: { id, name, date, type, description }
 */
export default function EventComponent({ event }) {
    const [isComplete, setIsComplete] = useState(false);

    if (!event) return null;
    const { id, name, date, type, description } = event;

    function toggleComplete(isCompleted = !isComplete) {
        setIsComplete(isCompleted);
    }

    // base classes reused across variants
    const baseClasses =
        "max-w-md w-full mx-auto p-6 rounded-2xl border shadow-xl";

    // decide style based on event type or completion
    let typeClasses;

    switch ((type || "default").toLowerCase()) {
        case EventType.SPECIAL.toLowerCase():
            // Special: vivid color
            typeClasses =
                "bg-gradient-to-br from-pink-500 via-rose-500 to-amber-400 text-white border-pink-600";
            break;
        case EventType.DEPARTURE.toLowerCase():
            // Departure: dark blue
            typeClasses =
                "bg-gradient-to-br from-slate-900 to-indigo-900 text-white border-blue-800";
            break;
        case EventType.MATCH.toLowerCase():
            // Match: animated rainbow using inline styles since CDN doesn't support custom config
            typeClasses = "text-white border-gray-700";
            break;
        default:
            // Default: original dark gradient
            typeClasses =
                "bg-gradient-to-br from-gray-900 via-gray-800 to-neutral-900 text-white border-gray-800";
            break;
    }

    const containerClassName = `${baseClasses} ${typeClasses}`;

    // Special inline styles for rainbow animation (MATCH events)
    const rainbowStyle = type && type.toLowerCase() === EventType.MATCH.toLowerCase()
        ? {
            background: 'linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab, #f093fb, #f5576c, #4facfe, #00f2fe)',
            backgroundSize: '400% 400%',
            animation: 'rainbow 4s ease infinite'
        }
        : {};

    return (
        <>
            {/* Add CSS keyframes for rainbow animation */}
            {type && type.toLowerCase() === EventType.MATCH.toLowerCase() && (
                <style>
                    {`
                        @keyframes rainbow {
                            0% { background-position: 0% 50%; }
                            50% { background-position: 100% 50%; }
                            100% { background-position: 0% 50%; }
                        }
                    `}
                </style>
            )}
            <article
                key={id}
                className={containerClassName + (isComplete ? " opacity-30" : "")}
                style={rainbowStyle}
                aria-labelledby={`event-${id}-title`}
            >
                <header className="flex items-start justify-between gap-4">
                    <div>
                        <h3
                            id={`event-${id}-title`}
                            className="text-lg sm:text-xl font-semibold tracking-tight"
                        >
                            {name}
                        </h3>
                        <p className={`mt-1 text-sm max-w-prose ${isComplete || (type && type.toLowerCase() === "completed") ? "text-gray-600" : "text-gray-300"}`}>
                            {description}
                        </p>
                        <p className={`mt-2 text-sm  ${isComplete || (type && type.toLowerCase() === "completed") ? "text-gray-600" : "text-gray-300"}`}>
                            {(() => {
                                if (!date) return "No date";
                                const d = typeof date === "string" ? new Date(date) : date;
                                if (Number.isNaN(d.getTime())) return "Invalid date";
                                return d.toLocaleString(undefined, {
                                    weekday: "short",
                                    year: "numeric",
                                    month: "short",
                                    day: "numeric",
                                    hour: "2-digit",
                                    minute: "2-digit",
                                });
                            })()}
                        </p>
                    </div>

                    <div className="ml-3 shrink-0">
                        <span className="inline-block px-3 py-1 rounded-full text-xs font-medium bg-gray-800/60 text-gray-200 border border-gray-700">
                            {type ? (type.charAt(0).toUpperCase() + type.slice(1)) : "Event"}
                        </span>
                    </div>
                </header>

                <div className="mt-5">
                    {/* Timer component receives the event date */}
                    <TimerComponent
                        targetDate={date}
                        toggleComplete={toggleComplete}
                        isComplete={isComplete}
                        event={event}
                    />
                </div>
            </article>
        </>
    );
}

EventComponent.propTypes = {
    event: PropTypes.shape({
        id: PropTypes.oneOfType([PropTypes.string, PropTypes.number]),
        name: PropTypes.string.isRequired,
        date: PropTypes.oneOfType([PropTypes.string, PropTypes.instanceOf(Date)])
            .isRequired,
        type: PropTypes.string,
        description: PropTypes.string,
    }).isRequired,
};
