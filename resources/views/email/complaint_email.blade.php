@component('mail::message')
# Complaint Details

**Reference Number:** {{ $complaint->complaint_ref }}

**Description:**
{{ $complaint->descriptions }}

Thank you for your attention to this matter.

Sincerely,
Your Company
@endcomponent
