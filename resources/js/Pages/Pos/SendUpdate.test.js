import { describe, it, expect } from 'vitest';
import SendUpdate from "./SendUpdate.vue";
import { router } from "@inertiajs/vue3";
import { fireEvent, render } from "@testing-library/vue";

vi.mock('@inertiajs/vue3', () => ({
  router: {
    post: vi.fn(),
  },
  Link: vi.fn(),
}));

const pageProps = {
  props: {
    flash: null,
  }
};

describe('SendUpdate', () => {
  it('loads the buttons to change status of pizza', () => {
    const { getByRole } = render(SendUpdate, {
      global: {
        mocks: {
          $page: pageProps,
        },
      }
    });

    expect(getByRole('button', { name: 'Making the Pizza' })).toBeDefined();
    expect(getByRole('button', { name: 'Pizza is in the oven' })).toBeDefined();
    expect(getByRole('button', { name: 'Pizza is ready!' })).toBeDefined();
  });

  it.each([
    ['Making the Pizza', 'making'],
    ['Pizza is in the oven', 'cooking'],
    ['Pizza is ready!', 'ready'],
  ])('makes a request to update status of the pizza', async (buttonLabel, status) => {
    const { getByRole } = render(SendUpdate, {
      global: {
        mocks: {
          $page: pageProps,
        },
      }
    });

    await fireEvent.click(getByRole('button', { name: buttonLabel }));

    expect(router.post).toHaveBeenCalledWith('/pos/send-update', {
      status: status,
    }, expect.anything());
  });
});