<footer style="background:#060914;border-top:1px solid rgba(255,255,255,0.06)" class="mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <div>
            <span class="text-xl font-bold gradient-text">engineers<span class="text-white">Tech</span></span>
            <p class="mt-3 text-sm" style="color:var(--muted)">AI-Driven Software Engineering. Enterprise-grade solutions from a lean team of skilled engineers.</p>
        </div>
        <div>
            <h4 class="text-sm font-semibold mb-3">Quick Links</h4>
            <ul class="space-y-2">
                @foreach([['home','Home'],['services','Services'],['products','Products'],['about','About Us'],['blog','Blog'],['contact','Contact']] as [$r,$l])
                <li><a href="{{ route($r) }}" class="text-sm nav-link">{{ $l }}</a></li>
                @endforeach
            </ul>
        </div>
        <div>
            <h4 class="text-sm font-semibold mb-3">Contact</h4>
            <ul class="space-y-2 text-sm" style="color:var(--muted)">
                <li>info@engineerstechbd.com</li>
                <li>+880-18737-22228</li>
                <li>01689877007</li>
                <li>Dhaka, Bangladesh</li>
            </ul>
        </div>
        <div>
            <h4 class="text-sm font-semibold mb-3">Legal</h4>
            <p class="text-sm" style="color:var(--muted)">Reg: TRAD/DNCC/025495/2025</p>
            <a href="https://e-cab.net/" target="_blank" class="text-sm nav-link mt-1 block">e-CAB Member</a>
        </div>
    </div>
    <div class="border-t text-center py-4 text-xs" style="border-color:rgba(255,255,255,0.06);color:var(--muted)">
        &copy; {{ date('Y') }} engineersTech. All rights reserved. #drivenByEngineers
    </div>
</footer>
