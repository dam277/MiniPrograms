import React, { useEffect, useState } from "react";

/**
 * Countdown Timer (Tailwind dark modern)
 * Props:
 *  - targetDate: Date | string | number (required)
 *  - onComplete: function called when countdown reaches zero (optional)
 *
 * Place this component inside another; Tailwind must be installed in the app.
 */
export default function TimerComponent({ targetDate, toggleComplete, isComplete, event } = {}) 
{
    const parseTarget = (t) => (t instanceof Date ? t : new Date(t));
    const target = parseTarget(targetDate);

    const calc = () => {
        const total = target - Date.now();
        const clamped = Math.max(0, total);
        const seconds = Math.floor((clamped / 1000) % 60);
        const minutes = Math.floor((clamped / (1000 * 60)) % 60);
        const hours = Math.floor((clamped / (1000 * 60 * 60)) % 24);
        const days = Math.floor(clamped / (1000 * 60 * 60 * 24));
        return { total, days, hours, minutes, seconds };
    };

    const [time, setTime] = useState(calc());

    useEffect(() => {
        // Recompute immediately in case targetDate prop changed
        setTime(calc());

        if (time.total <= 0) {
            if (toggleComplete) toggleComplete(true);
            return;
        }
        else {
            if (isComplete && toggleComplete) toggleComplete(false);
        }

        const id = setInterval(() => {
            const next = calc();
            setTime(next);
            if (next.total <= 0) {
                clearInterval(id);
                if (toggleComplete) toggleComplete(true);
            }
        }, 1000);

        return () => clearInterval(id);
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [targetDate]);

    const pad = (n) => String(n).padStart(2, "0");

    if (time.total <= 0) {
        return (
            <div
                aria-live="polite"
                className="inline-flex items-center px-4 py-2 rounded-lg bg-gradient-to-br from-gray-800 via-neutral-900 to-black text-white shadow-lg ring-1 ring-white/5"
            >
                Time's up!
            </div>
        );
    }

    return (
        <div
            aria-live="polite"
            role="timer"
            className="inline-flex items-center gap-3 sm:gap-4 p-3 rounded-xl bg-gradient-to-br from-gray-900 via-neutral-900 to-black/80 text-white shadow-2xl ring-1 ring-white/6"
        >
            {/* container style gives a modern dark glassy look; individual blocks are semi-transparent */}
            <TimeBlock label="Days" value={time.days} isLarge />

            <div className="w-px h-8 bg-white/6 rounded mx-1" />

            <TimeBlock label="Hours" value={pad(time.hours)} />
            <TimeBlock label="Minutes" value={pad(time.minutes)} />
            <TimeBlock label="Seconds" value={pad(time.seconds)} />
        </div>
    );
}

function TimeBlock({ label, value, isLarge = false }) {
    return (
        <div className={`flex flex-col items-center ${isLarge ? "min-w-[72px]" : "min-w-[52px]"}`}>
            <div
                className={`
                    w-full flex items-center justify-center px-3 py-2 rounded-lg
                    ${isLarge ? "text-2xl sm:text-3xl font-extrabold" : "text-lg sm:text-xl font-semibold"}
                    bg-gradient-to-b from-white/3 to-white/2 text-white/100
                    backdrop-blur-sm shadow-md tracking-wide
                `}
            >
                <span className="font-mono">{value}</span>
            </div>
            <div className="mt-1 text-xs uppercase text-gray-400 tracking-wide">{label}</div>
        </div>
    );
}