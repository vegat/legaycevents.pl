<?php
$seo_title = "Kontakt - Agencja LegacyEvents";
$seo_description = "Skontaktuj się z nami. Napisz lub zadzwoń, a wycenimy i zorganizujemy Twój wymarzony event."; require_once 'header.php'; ?>

<main class="page-wrapper">
    <section class="subpage-hero">
        <h1 class="subpage-title">Skontaktuj <span class="magical-text">się z nami</span></h1>
        <p class="subpage-subtitle">Masz pomysł na wydarzenie? Szukasz sprzętu lub animatorów? Napisz do nas – stwórzmy
            razem coś niezapomnianego.</p>
    </section>

    <section class="content-section text-content">
        <div style="display: flex; gap: 60px; flex-wrap: wrap;">
            <!-- Dane kontaktowe -->
            <div style="flex: 1; min-width: 300px;">
                <h2 style="font-family: var(--font-heading); color: #fff; margin-bottom: 20px;">Dane kontaktowe</h2>

                <div style="margin-bottom: 30px;">
                    <h3 style="color: var(--primary-color); font-size: 1rem; margin-bottom: 5px;">Dane firmy</h3>
                    <p style="color: #fff; font-weight: 500;">
                        Legacy Events By Michał Lipa<br>
                        NIP: 6951540199<br>
                        Nowa Wieś Wielka 35,<br>
                        59-411, Paszowice
                    </p>
                </div>

                <div style="margin-bottom: 30px;">
                    <h3 style="color: var(--primary-color); font-size: 1rem; margin-bottom: 5px;">Adres siedziby</h3>
                    <p style="color: #fff; font-weight: 500;">Bolków, Dolnośląskie, Polska</p>
                </div>

                <div style="margin-bottom: 30px;">
                    <h3 style="color: var(--primary-color); font-size: 1rem; margin-bottom: 5px;">Kontakt</h3>
                    <p style="color: #fff; font-weight: 500;">
                        Telefon: 780 752 938<br>
                        Email: kontakt@legacyevents.pl
                    </p>
                </div>

                <div style="margin-top: 40px;">
                    <h3 style="font-family: var(--font-heading); color: #fff; margin-bottom: 15px;">Znajdź nas w sieci
                    </h3>
                    <div style="display: flex; gap: 15px;">
                        <a href="https://www.facebook.com/profile.php?id=61560702814608" target="_blank"
                            style="width: 40px; height: 40px; background: rgba(255,255,255,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: background 0.3s;"
                            onmouseover="this.style.background='var(--primary-color)'"
                            onmouseout="this.style.background='rgba(255,255,255,0.1)'">FB</a>
                        <a href="https://instagram.com/legacy_events_poland" target="_blank"
                            style="width: 40px; height: 40px; background: rgba(255,255,255,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: background 0.3s;"
                            onmouseover="this.style.background='var(--primary-color)'"
                            onmouseout="this.style.background='rgba(255,255,255,0.1)'">IG</a>
                        <a href="https://www.youtube.com/@Legacy_Events_Poland" target="_blank"
                            style="width: 40px; height: 40px; background: rgba(255,255,255,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: background 0.3s;"
                            onmouseover="this.style.background='var(--primary-color)'"
                            onmouseout="this.style.background='rgba(255,255,255,0.1)'">YT</a>
                    </div>
                </div>
            </div>

            <!-- Formularz -->
            <div
                style="flex: 1.5; min-width: 300px; background: var(--card-bg); padding: 40px; border-radius: 12px; border: 1px solid var(--border-color);">
                <form id="contact-form" style="display: flex; flex-direction: column; gap: 20px;">
                    <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                        <div style="flex: 1; min-width: 200px;">
                            <label for="name" style="display: block; margin-bottom: 8px; font-size: 0.9rem;">Imię i
                                nazwisko</label>
                            <input type="text" id="name" name="name" required
                                style="width: 100%; padding: 12px 15px; background: rgba(0,0,0,0.5); border: 1px solid rgba(255,255,255,0.2); border-radius: 6px; color: #fff; font-family: var(--font-main); outline: none; transition: border-color 0.3s;"
                                onfocus="this.style.borderColor='var(--primary-color)'"
                                onblur="this.style.borderColor='rgba(255,255,255,0.2)'">
                        </div>
                        <div style="flex: 1; min-width: 200px;">
                            <label for="email" style="display: block; margin-bottom: 8px; font-size: 0.9rem;">Adres
                                Email</label>
                            <input type="email" id="email" name="email" required
                                style="width: 100%; padding: 12px 15px; background: rgba(0,0,0,0.5); border: 1px solid rgba(255,255,255,0.2); border-radius: 6px; color: #fff; font-family: var(--font-main); outline: none; transition: border-color 0.3s;"
                                onfocus="this.style.borderColor='var(--primary-color)'"
                                onblur="this.style.borderColor='rgba(255,255,255,0.2)'">
                        </div>
                    </div>

                    <div>
                        <label for="phone" style="display: block; margin-bottom: 8px; font-size: 0.9rem;">Telefon
                            <span style="color: var(--text-muted); font-weight: 400;">(opcjonalnie)</span></label>
                        <input type="tel" id="phone" name="phone"
                            style="width: 100%; padding: 12px 15px; background: rgba(0,0,0,0.5); border: 1px solid rgba(255,255,255,0.2); border-radius: 6px; color: #fff; font-family: var(--font-main); outline: none; transition: border-color 0.3s;"
                            onfocus="this.style.borderColor='var(--primary-color)'"
                            onblur="this.style.borderColor='rgba(255,255,255,0.2)'">
                    </div>

                    <div>
                        <label for="subject"
                            style="display: block; margin-bottom: 8px; font-size: 0.9rem;">Temat</label>
                        <select id="subject" name="subject"
                            style="width: 100%; padding: 12px 15px; background: rgba(0,0,0,0.5); border: 1px solid rgba(255,255,255,0.2); border-radius: 6px; color: #fff; font-family: var(--font-main); outline: none; appearance: none; transition: border-color 0.3s;"
                            onfocus="this.style.borderColor='var(--primary-color)'"
                            onblur="this.style.borderColor='rgba(255,255,255,0.2)'">
                            <option value="Organizacja Wydarzenia">Organizacja Wydarzenia</option>
                            <option value="Wypożyczenie Techniki / Obsługa">Wypożyczenie Techniki / Obsługa</option>
                            <option value="Animacje / Wynajem Aktorów">Animacje / Wynajem Aktorów</option>
                            <option value="Inne">Inne</option>
                        </select>
                    </div>

                    <div>
                        <label for="message"
                            style="display: block; margin-bottom: 8px; font-size: 0.9rem;">Wiadomość</label>
                        <textarea id="message" name="message" rows="5" required
                            style="width: 100%; padding: 12px 15px; background: rgba(0,0,0,0.5); border: 1px solid rgba(255,255,255,0.2); border-radius: 6px; color: #fff; font-family: var(--font-main); outline: none; resize: vertical; transition: border-color 0.3s;"
                            onfocus="this.style.borderColor='var(--primary-color)'"
                            onblur="this.style.borderColor='rgba(255,255,255,0.2)'"></textarea>
                    </div>

                    <div id="form-status" style="display: none; padding: 15px; border-radius: 8px; text-align: center; font-weight: 500;"></div>

                    <button type="submit" id="submit-btn" class="cta-button primary"
                        style="width: 100%; margin-top: 10px; border: none;">Wyślij wiadomość</button>
                </form>
            </div>
        </div>
    </section>
</main>

<script>
document.getElementById('contact-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    const btn = document.getElementById('submit-btn');
    const status = document.getElementById('form-status');
    const form = this;

    btn.disabled = true;
    btn.textContent = 'Wysyłanie...';
    status.style.display = 'none';

    const payload = {
        title: form.querySelector('#name').value.trim(),
        email: form.querySelector('#email').value.trim(),
        phone: form.querySelector('#phone').value.trim(),
        subject: form.querySelector('#subject').value,
        message: form.querySelector('#message').value.trim()
    };

    try {
        const res = await fetch('msg.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });
        const data = await res.json();

        if (data.status === 'ok') {
            status.textContent = 'Wiadomość została wysłana! Odpowiemy najszybciej jak to możliwe.';
            status.style.display = 'block';
            status.style.background = 'rgba(39, 201, 63, 0.15)';
            status.style.border = '1px solid rgba(39, 201, 63, 0.4)';
            status.style.color = '#27c93f';
            form.reset();
        } else {
            throw new Error(data.desc || 'Nieznany błąd');
        }
    } catch (err) {
        status.textContent = 'Wystąpił błąd podczas wysyłania. Spróbuj ponownie lub napisz bezpośrednio na kontakt@legacyevents.pl';
        status.style.display = 'block';
        status.style.background = 'rgba(255, 95, 86, 0.15)';
        status.style.border = '1px solid rgba(255, 95, 86, 0.4)';
        status.style.color = '#ff5f56';
    } finally {
        btn.disabled = false;
        btn.textContent = 'Wyślij wiadomość';
    }
});
</script>

<?php require_once 'footer.php'; ?>